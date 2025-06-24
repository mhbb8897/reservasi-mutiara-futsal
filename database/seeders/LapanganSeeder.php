<?php

namespace Database\Seeders;

use App\Models\Lapangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    public function run(): void
    {
        $lapangans = [
            [
                'nama' => 'Lapangan A',
                'deskripsi' => 'Lantai Vinyl',
                'harga_per_jam' => 150000,
                'images' => json_encode(['image/lapangan-a.jpg']),
            ],
            [
                'nama' => 'Lapangan B',
                'deskripsi' => 'Lantai Vinyl',
                'harga_per_jam' => 150000,
                'images' => json_encode(['image/lapangan-b.jpg']),
            ],
            [
                'nama' => 'Lapangan C',
                'deskripsi' => 'Lantai Interlock',
                'harga_per_jam' => 150000,
                'images' => json_encode(['image/lapangan-c.jpg']),
            ],
        ];

        foreach ($lapangans as $lapangan) {
            Lapangan::create($lapangan);
        }
    }
}
