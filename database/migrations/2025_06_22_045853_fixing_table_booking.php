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
        // Schema::create('bookings', function (Blueprint $table) {
        //     $table->id();
        //     // Relasi ke tabel users dan lapangans
        //     $table->foreignId('user_id')
        //         ->constrained()
        //         ->onDelete('cascade');
        //     $table->foreignId('lapangan_id')
        //         ->constrained('lapangans')
        //         ->onDelete('cascade');
        //     // Data booking
        //     $table->date('tanggal_booking');
        //     $table->time('waktu_mulai');
        //     $table->time('waktu_selesai');
        //     // Status booking
        //     $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        //     $table->enum('jenis_pembayaran', ['dp', 'setengah', 'penuh']);
        //     $table->integer('nominal');
        //     $table->timestamps();
        // });
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // relasi
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('lapangan_id')
                  ->constrained('lapangans')
                  ->onDelete('cascade');

            // jadwal
            $table->date('tanggal_booking');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');

            // status proses booking
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])
                  ->default('pending');

            // estimasi biaya (jika ingin ditampilkan sebelum bayar)
            $table->unsignedInteger('nominal');   // contoh: 75000

            $table->timestamps();
        });

        /*
         |------------------------------------------------------------------
         | 2.  pembayarans  (relsi→bookings)
         |------------------------------------------------------------------
         */
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->onDelete('cascade');

            // tipe pembayaran (dp / setengah / penuh)
            $table->enum('ket_pembayaran', ['dp', 'setengah', 'penuh']);

            // gateway / channel
            $table->string('metode_pembayaran');     // contoh: qris, bank_transfer, gopay …

            // total dibayar
            $table->decimal('total', 12, 2);

            // waktu pembayaran sukses
            $table->timestamp('paid_at')->nullable();

            // status transaksi Midtrans
            $table->enum('status', ['waiting', 'paid', 'failed'])
                  ->default('waiting');

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
