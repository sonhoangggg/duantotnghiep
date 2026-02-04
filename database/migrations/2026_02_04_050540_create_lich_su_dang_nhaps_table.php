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
        Schema::create('lich_su_dang_nhaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dungs')->cascadeOnDelete();
            $table->string('dia_chi_ip',100);
            $table->string('thiet_bi',100)->nullable();
            $table->string('trinh_duyet')->nullable();
            $table->enum('hanh_dong',['dang_nhap','dang_xuat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_dang_nhaps');
    }
};
