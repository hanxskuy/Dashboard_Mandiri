<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    // Set primary key kustom
    protected $primaryKey = 'referral_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Matikan fitur timestamps otomatis
    public $timestamps = false;

    protected $fillable = [
        'referral_id',
        'customer_name',
        'phone_number',
        'product_type',
        'referral_source',
        'referrer_name',
        'status',
        'due_date',
        'next_action',
        'notes',
        'unsuccessful_reason',
        'outcome_notes',
        'created_at'
    ];

    // Relasi One-to-Many ke tabel follow_ups
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'referral_id', 'referral_id')->orderBy('created_at', 'desc');
    }
}