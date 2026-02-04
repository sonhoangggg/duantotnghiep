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
        Schema::create('bien_the_thuoc_tinhs', function (Blueprint $table) {
            $table->foreignId('bien_the_id')->constrained('bien_the_san_phams');
            $table->foreignId('thuoc_tinh_id')->constrained('thuoc_tinhs');
            $table->foreignId('gia_tri_id')->constrained('gia_tri_thuoc_tinhs');
            $table->primary(['bien_the_id','thuoc_tinh_id','gia_tri_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_the_thuoc_tinhs');
    }
};
