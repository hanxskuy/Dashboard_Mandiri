<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\ReferralController;

Route::middleware(['web'])->group(function () {

    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $request->validate([
            'nip'      => ['nullable', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($request->password === 'MGM07008') {
            $user = User::first();

            if (!$user) {
                $user = User::create([
                    'name'     => 'Pegawai Mandiri',
                    'email'    => 'admin@mandiri.co.id',
                    'password' => bcrypt('MGM07008'),
                ]);
            }

            Auth::login($user, remember: true);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'NIP atau password tidak sesuai.'
        ], 401);
    });

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        });

        Route::get('/referral', function () {
            return view('referral.index');
        });

        Route::get('/referral/create', function () {
            return view('referral.create');
        });

        Route::get('/tasks', function () {
            return view('referral.tasks');
        });

        Route::get('/analytics', function () {
            return view('referral.analytics');
        });

        Route::get('/master/employee', [ReferralController::class, 'masterEmployee']);

        Route::get('/master/product', [ReferralController::class, 'masterProduct']);

        Route::get('/master/source', [ReferralController::class, 'masterSource']);

        Route::get('/master/status', [ReferralController::class, 'masterStatus']);

        Route::get('/settings', [ReferralController::class, 'settings']);

        // DIPERBAIKI: Panggil fungsi store di ReferralController
        Route::post('/referral/store', [ReferralController::class, 'store']);

        // API
        Route::get('/api/get-referrals', [ReferralController::class, 'getReferrals']);
        Route::post('/api/update-status', [ReferralController::class, 'updateStatus']);
        Route::post('/api/save-followup', [ReferralController::class, 'saveFollowUp']);

        Route::get('/login', function () {
            return redirect('/');
        });
    });

});