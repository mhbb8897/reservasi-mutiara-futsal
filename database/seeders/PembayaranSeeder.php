<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $booking = Booking::first();

        Pembayaran::create([
            'booking_id' => $booking->id,
            'metode_pembayaran' => 'qris',
            'total' => 50000,
            'status' => 'paid',
            'paid_at' => now(),
        ]);
    }
}
