<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->enum('payment_method', ['Transfer', 'COD'])->default('Transfer');
            $table->enum('payment_status', ['Pending', 'Lunas', 'Gagal'])->default('Pending');
            $table->string('proof_image')->nullable(); // nama file bukti pembayaran
            $table->timestamp('paid_at')->nullable(); // waktu pembayaran
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
