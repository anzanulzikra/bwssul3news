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
        Schema::create('e_monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('satuan_kerja');
            $table->decimal('realisasi_fisik', 5, 2); // contoh: 99.99%
            $table->timestamp('last_updated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_monitorings');
    }
};
