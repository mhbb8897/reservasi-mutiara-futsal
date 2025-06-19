<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // if (Lapangan::count() == 0) {
        //     Lapangan::insert([
        //         ['name' => 'Lapangan A', 'description' => 'Lantai Vinyl', 'harga_per_jam' => 150000, 'created_at' => now(), 'updated_at' => now()],
        //         ['name' => 'Lapangan B', 'description' => 'Lantai Vinyl', 'harga_per_jam' => 150000, 'created_at' => now(), 'updated_at' => now()],
        //         ['name' => 'Lapangan C', 'description' => 'Lantai Interlock', 'harga_per_jam' => 130000, 'created_at' => now(), 'updated_at' => now()],
        //     ]);
        // }

        $lapangans = Lapangan::all();

        // Buat 5 user dan booking masing-masing
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'phone' => "08123456" . rand(1000, 9999),
                'password' => Hash::make('password'),
            ]);

            Booking::create([
                'user_id' => $user->id,
                'lapangan_id' => $lapangans->random()->id,
                'tanggal_booking' => now()->addDays($i)->toDateString(),
                'waktu_mulai' => '19:00:00',
                'waktu_selesai' => '20:00:00',
                'status' => 'confirmed',
            ]);
        }


    }
}
