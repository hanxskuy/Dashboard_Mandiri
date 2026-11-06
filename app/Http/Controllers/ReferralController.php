<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\FollowUp;
use Carbon\Carbon;

class ReferralController extends Controller
{
    // 1. Dapatkan Semua Data Referral & FollowUp (JSON Response untuk API)
    public function getReferrals()
    {
        try {
            $referrals = Referral::with('followUps')->orderBy('id', 'desc')->get();

            $data = $referrals->map(function ($item) {
                $createdAtFormatted = '-';
                $defaultDueDate = '-';

                if (!empty($item->created_at)) {
                    $carbonCreatedAt = Carbon::parse($item->created_at);
                    $createdAtFormatted = $carbonCreatedAt->format('Y-m-d');
                    // Otomatis 9 hari dari tanggal masuk
                    $defaultDueDate = $carbonCreatedAt->addDays(9)->format('Y-m-d');
                }

                $followUpsList = $item->followUps ?? collect();

                // Saring hanya riwayat kontak riil (bukan log Sistem) untuk tampilan daftar riwayat
                $realFollowUps = $followUpsList->filter(function ($fu) {
                    return $fu->method !== 'Sistem';
                });

                $dueDate = $item->due_date ?? $defaultDueDate;
                $nextAction = $item->next_action ?? ($realFollowUps->count() > 0 ? '-' : 'Hubungi calon nasabah');

                // Deteksi Last Follow Up dari semua aktivitas (termasuk update Next Action)
                $lastFollowUpDate = '-';
                if ($followUpsList->count() > 0) {
                    $latestFu = $followUpsList->last();
                    $lastFollowUpDate = $latestFu->follow_up_date ?? date('Y-m-d', strtotime($latestFu->created_at));
                } else {
                    $lastFollowUpDate = $createdAtFormatted;
                }

                return [
                    'id'                  => $item->id,
                    'referral_id'         => $item->referral_id ?? '-',
                    'customer_name'       => $item->customer_name ?? '-',
                    'phone_number'        => $item->phone_number ?? '-',
                    'product_type'        => $item->product_type ?? '-',
                    'referral_source'     => $item->referral_source ?? '-',
                    'referrer_name'       => $item->referrer_name ?? '-',
                    'created_at'          => $createdAtFormatted,
                    'status'              => $item->status ?? 'Baru',
                    'due_date'            => $dueDate,
                    'next_action'         => $nextAction,
                    'last_follow_up'      => $lastFollowUpDate,
                    'notes'               => $item->notes ?? '-',
                    'unsuccessful_reason' => $item->unsuccessful_reason ?? null,
                    'outcome_notes'       => $item->outcome_notes ?? null,
                    // HANYA kirim riwayat kontak riil ke frontend
                    'history'             => $realFollowUps->map(function ($fu) {
                        $fuDate = $fu->follow_up_date;
                        if (empty($fuDate) && !empty($fu->created_at)) {
                            $fuDate = date('Y-m-d', strtotime($fu->created_at));
                        }

                        return [
                            'date'        => $fuDate ?? '-',
                            'method'      => $fu->method ?? '-',
                            'result'      => $fu->result ?? '-',
                            'notes'       => $fu->notes ?? '-',
                            'next_action' => $fu->next_action ?? '-',
                            'due_date'    => $fu->due_date ?? '-'
                        ];
                    })->reverse()->values()
                ];
            });

            return response()->json([
                'success' => true,
                'data'    => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // 2. Simpan Referral Baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'   => 'required|string',
            'phone_number'    => 'required|string',
            'product_type'    => 'required|string',
            'referral_source' => 'required|string',
            'created_at'      => 'required|date'
        ]);

        $maxNumber = Referral::where('referral_id', 'LIKE', 'REF-GM-%')
            ->selectRaw("MAX(CAST(SUBSTRING(referral_id, 8) AS UNSIGNED)) as max_num")
            ->value('max_num');

        $nextNumber = ($maxNumber ? $maxNumber : 0) + 1;
        $referralId = 'REF-GM-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Hitung Due Date +9 hari secara otomatis
        $autoDueDate = Carbon::parse($request->created_at)->addDays(9)->format('Y-m-d');

        Referral::create([
            'referral_id'     => $referralId,
            'customer_name'   => $request->customer_name,
            'phone_number'    => $request->phone_number,
            'product_type'    => $request->product_type,
            'referral_source' => $request->referral_source,
            'referrer_name'   => $request->referrer_name,
            'status'          => 'Baru',
            'created_at'      => $request->created_at,
            'due_date'        => $autoDueDate,
            'next_action'     => 'Hubungi calon nasabah',
            'notes'           => $request->notes
        ]);

        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();

        return view('referral.success', [
            'referral_id' => $referralId,
            'taskCount'   => $taskCount
        ]);
    }

    // 3. Update Status
    public function updateStatus(Request $request)
    {
        $request->validate([
            'referral_id' => 'required',
            'status'      => 'required'
        ]);

        $referral = Referral::where('referral_id', $request->input('referral_id'))
            ->orWhere('id', $request->input('referral_id'))
            ->first();

        if ($referral) {
            $referral->status = $request->input('status');

            if ($request->input('status') === 'Tidak Berhasil') {
                $referral->unsuccessful_reason = $request->input('unsuccessful_reason');
                $referral->outcome_notes = null;
            } else if ($request->input('status') === 'Berhasil') {
                $referral->outcome_notes = $request->input('outcome_notes');
                $referral->unsuccessful_reason = null;
            } else {
                $referral->unsuccessful_reason = null;
                $referral->outcome_notes = null;
            }

            $referral->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data referral tidak ditemukan.'
        ], 404);
    }

    // 4. Simpan Follow-up / Next Action Permanen ke Database
    public function saveFollowUp(Request $request)
    {
        $request->validate([
            'referral_id'    => 'required',
            'follow_up_date' => 'nullable|date',
            'method'         => 'nullable|string',
            'result'         => 'nullable|string',
            'notes'          => 'nullable|string',
            'next_action'    => 'nullable|string',
            'due_date'       => 'nullable|date'
        ]);

        $referralIdInput = $request->input('referral_id');
        $referral = Referral::where('referral_id', $referralIdInput)
            ->orWhere('id', $referralIdInput)
            ->first();

        if (!$referral) {
            return response()->json([
                'success' => false,
                'message' => 'Data referral tidak ditemukan.'
            ], 404);
        }

        // 1. Update data utama pada tabel referrals
        if ($request->filled('due_date')) {
            $referral->due_date = $request->input('due_date');
        }
        if ($request->filled('next_action')) {
            $referral->next_action = $request->input('next_action');
        }
        $referral->save();

        // 2. Simpan record aktivitas ke tabel follow_ups
        $activityDate = $request->input('follow_up_date') ?? date('Y-m-d');
        $isRealContact = $request->filled('method') || $request->filled('result') || $request->filled('notes');

        FollowUp::create([
            'referral_id'    => $referral->referral_id,
            'follow_up_date' => $activityDate,
            'method'         => $isRealContact ? ($request->input('method') ?: 'Telepon') : 'Sistem',
            'result'         => $isRealContact ? ($request->input('result') ?: 'Proses') : 'Update Action',
            'notes'          => $isRealContact ? $request->input('notes') : 'Pembaruan Rencana Action',
            'next_action'    => $request->input('next_action'),
            'due_date'       => $request->input('due_date')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!'
        ]);
    }

    // 5. Render Halaman Index Daftar Referral
    public function index()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('referral.index', compact('taskCount', 'referralCount'));
    }

    // 6. Render Halaman Dashboard
    public function dashboard()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('dashboard', compact('taskCount', 'referralCount'));
    }

    // 7. Render Halaman Tambah Referral Baru
    public function create()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('referral.create', compact('taskCount', 'referralCount'));
    }

    // 8. Render Halaman Tugas Saya
    public function tasks()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('referral.tasks', compact('taskCount', 'referralCount'));
    }

    public function analytics()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('analytics', compact('taskCount', 'referralCount'));
    }

    public function masterEmployee()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('master.employee', compact('taskCount', 'referralCount'));
    }

    public function masterProduct()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('master.product', compact('taskCount', 'referralCount'));
    }

    public function masterSource()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('master.source', compact('taskCount', 'referralCount'));
    }

    public function masterStatus()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('master.status', compact('taskCount', 'referralCount'));
    }

    public function settings()
    {
        $todayStr = Carbon::now()->toDateString();
        $taskCount = Referral::where('due_date', '<=', $todayStr)->orWhere('status', 'Baru')->count();
        $referralCount = Referral::where('status', 'Baru')->count();

        return view('settings.index', compact('taskCount', 'referralCount'));
    }
}