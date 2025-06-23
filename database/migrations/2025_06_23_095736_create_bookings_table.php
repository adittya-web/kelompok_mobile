<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // pelanggan
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // jenis layanan
            $table->float('weight'); // berat laundry (kg)
            $table->date('pickup_date'); // tanggal penjemputan
            $table->string('address'); // alamat penjemputan
            $table->decimal('total_price', 10, 2); // total harga
            $table->enum('status', ['Menunggu Konfirmasi', 'Dijemput', 'Diproses', 'Selesai', 'Dikirim', 'Dibatalkan'])->default('Menunggu Konfirmasi');
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
