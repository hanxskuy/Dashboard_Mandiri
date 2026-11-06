<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $table = 'follow_ups';

    // WAJIB: Matikan timestamps otomatis karena tabel tidak punya kolom updated_at
    public $timestamps = false;

    protected $fillable = [
        'referral_id',
        'follow_up_date',
        'method',
        'result',
        'notes',
        'next_action',
        'due_date'
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class, 'referral_id', 'referral_id');
    }
}