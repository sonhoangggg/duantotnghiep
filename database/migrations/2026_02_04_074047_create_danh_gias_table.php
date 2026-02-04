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
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chi_tiet_don_hang_id')->constrained('chi_tiet_don_hangs');
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dungs');
            $table->tinyInteger('diem_so');
            $table->string('noi_dung')->nullable();
            $table->enum('trang_thai',['cho_duyet','da_duyet','tu_choi'])->default('cho_duyet');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
