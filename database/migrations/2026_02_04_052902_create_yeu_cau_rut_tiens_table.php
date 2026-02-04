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
        Schema::create('yeu_cau_rut_tiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vi_id')->constrained('vi_nguoi_dungs');
            $table->decimal('tien_rut',15,0);
            $table->string('ngan_hang');
            $table->string('stk_nguoi_nhan',150);
            $table->string('ghi_chu')->nullable();
            $table->enum('trang_thai',['cho_duyet','da_duyet','tu_choi'])->default('cho_duyet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_rut_tiens');
    }
};
