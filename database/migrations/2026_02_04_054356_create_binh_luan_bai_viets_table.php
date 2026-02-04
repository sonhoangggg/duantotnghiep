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
        Schema::create('binh_luan_bai_viets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bai_viet_id')->constrained('bai_viets');
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dungs');
            $table->string('ten_khach',150)->nullable();
            $table->string('email_khach')->nullable();
            $table->string('noi_dung');
            $table->foreignId('parent_id')->nullable()->constrained('binh_luan_bai_viets')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luan_bai_viets');
    }
};
