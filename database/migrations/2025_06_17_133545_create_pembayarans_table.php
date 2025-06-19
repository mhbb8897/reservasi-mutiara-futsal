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
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('metode_pembayaran'); // contoh: qris, transfer, cash
            $table->decimal('total', 10, 2);
            $table->string('bukti_pembayaran')->nullable(); // bisa upload bukti bayar
            $table->timestamp('paid_at')->nullable();
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
