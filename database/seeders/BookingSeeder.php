<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // $users = User::all();
        // $lapangans = Lapangan::all();

        // if ($users->isEmpty() || $lapangans->isEmpty()) {
        //     $this->command->warn('User atau Lapangan belum tersedia. Seeder dihentikan.');
        //     return;
        // }

        // foreach ($users as $user) {
        //     for ($i = 0; $i < 3; $i++) {
        //         $jenis_pembayaran = collect(['dp', 'setengah', 'penuh'])->random();
        //         $nominal = match ($jenis_pembayaran) {
        //             'dp' => 10000,
        //             'setengah' => 75000,
        //             'penuh' => 150000,
        //         };

        //         Booking::create([
        //             'user_id' => $user->id,
        //             'lapangan_id' => $lapangans->random()->id,
        //             'tanggal_booking' => now()->addDays($i)->toDateString(),
        //             'waktu_mulai' => '19:00:00',
        //             'waktu_selesai' => '20:00:00',
        //             'status' => 'confirmed',
        //             'jenis_pembayaran' => $jenis_pembayaran,
        //             'nominal' => $nominal,
        //         ]);
        //     }
        // }

        // $this->command->info('Seeder bookings berhasil dibuat.');
    }
}
