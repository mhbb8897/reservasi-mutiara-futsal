<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'metode_pembayaran',
        'total',
        'bukti_pembayaran',
        'paid_at',
        'status',
    ];

    protected $dates = ['paid_at'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
