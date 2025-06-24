<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users dan lapangans
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('lapangan_id')
                ->constrained('lapangans')
                ->onDelete('cascade');

            // Data booking
            $table->date('tanggal_booking');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');

            // Status booking
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('jenis_pembayaran', ['dp', 'setengah', 'penuh']);
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
