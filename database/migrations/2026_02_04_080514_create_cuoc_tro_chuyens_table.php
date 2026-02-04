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
        Schema::create('cuoc_tro_chuyens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->nullable()->constrained('nguoi_dungs');
            $table->string('session_id')->nullable();
            $table->foreignId('quan_tri_id')->nullable()->constrained('nguoi_dungs');
            $table->enum('trang_thai',['dang_mo','da_dong'])->default('dang_mo');
            $table->timestamp('tao_luc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuoc_tro_chuyens');
    }
};
