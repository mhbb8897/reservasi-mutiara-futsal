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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // Relasi ke booking
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            // Informasi pembayaran
            $table->string('metode_pembayaran')->default('qris'); // tetap ada jika ingin fleksibel ke depan
            $table->decimal('total', 10, 2); // total yang dibayarkan
            $table->timestamp('paid_at')->nullable(); // waktu pembayaran
            $table->enum('status', ['waiting', 'paid', 'failed'])->default('waiting');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
