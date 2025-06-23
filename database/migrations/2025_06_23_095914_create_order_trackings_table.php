<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('status'); // contoh: 'Dijemput', 'Diproses', dst
            $table->text('note')->nullable(); // catatan opsional dari admin
            $table->timestamps(); // waktu perubahan status
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_trackings');
    }
};
