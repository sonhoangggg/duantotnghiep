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
        Schema::create('ma_giam_gia_da_luus', function (Blueprint $table) {
            $table->foreignId('ma_giam_gia_id')->constrained('ma_giam_gias');
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dungs');
            $table->timestamp('luu_luc');
            $table->primary(['ma_giam_gia_id','nguoi_dung_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gia_da_luus');
    }
};
