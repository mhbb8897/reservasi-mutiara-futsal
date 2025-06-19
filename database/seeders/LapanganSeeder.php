<?php

namespace Database\Seeders;

use App\Models\Lapangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lapangans = [
            ['nama' => 'Lapangan A', 'deskripsi' => 'Lantai Vinyl', 'harga_per_jam' => 150000],
            ['nama' => 'Lapangan B', 'deskripsi' => 'Lantai Vinyl', 'harga_per_jam' => 150000],
            ['nama' => 'Lapangan C', 'deskripsi' => 'Lantai Interlock', 'harga_per_jam' => 130000],
        ];
        foreach ($lapangans as $lapangan) {
            Lapangan::create($lapangan);
        }
    }
}
