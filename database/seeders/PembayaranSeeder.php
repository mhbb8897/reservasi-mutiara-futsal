<?php

// namespace Database\Seeders;

// use App\Models\Booking;
// use App\Models\Pembayaran;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class PembayaranSeeder extends Seeder
// {
/**
 * Run the database seeds.
 */
//     public function run(): void
//     {
//         $booking = Booking::first();

//         Pembayaran::create([
//             'booking_id' => $booking->id,
//             'metode_pembayaran' => 'qris',
//             'total' => 50000,
//             'status' => 'paid',
//             'paid_at' => now(),
//         ]);
//     }
// }

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $users     = User::all();
        $lapangans = Lapangan::all();

        if ($users->isEmpty() || $lapangans->isEmpty()) {
            $this->command->warn('User atau Lapangan belum tersedia — Seeder dihentikan.');
            return;
        }

        DB::transaction(function () use ($users, $lapangans) {
            foreach ($users as $user) {
                // Buat 3 booking per user
                for ($i = 0; $i < 3; $i++) {
                    $lapangan = $lapangans->random();
                    $durasi   = 1;                                       // jam
                    $nominal  = $lapangan->harga_per_jam * $durasi;      // estimasi biaya

                    // ① Booking
                    $booking = Booking::create([
                        'user_id'          => $user->id,
                        'lapangan_id'      => $lapangan->id,
                        'tanggal_booking'  => now()->addDays($i)->toDateString(),
                        'waktu_mulai'      => '19:00:00',
                        'waktu_selesai'    => '20:00:00',
                        'status'           => 'confirmed',
                        'nominal'          => $nominal,
                    ]);

                    // ② Data pembayaran acak
                    $jenisPembayaran = Arr::random(['dp', 'setengah', 'penuh']);
                    $metodePembayaran = Arr::random(['qris', 'va', 'gopay']);

                    $dibayar = match ($jenisPembayaran) {
                        'dp'      => 0.2,      // 20 %
                        'setengah' => 0.5,      // 50 %
                        'penuh'   => 1.0,      // 100 %
                    };

                    // ③ Pembayaran
                    Pembayaran::create([
                        'booking_id'        => $booking->id,
                        'ket_pembayaran'  => $jenisPembayaran,
                        'metode_pembayaran' => $metodePembayaran,
                        'total'             => $nominal * $dibayar,
                        'status'            => 'paid',
                        'paid_at'           => now(),
                    ]);
                }
            }
        });

        $this->command->info('Seeder Booking & Pembayaran selesai.');
    }
}
