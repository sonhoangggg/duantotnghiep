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
        Schema::create('gia_tri_thuoc_tinhs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thuoc_tinh_id')->constrained('thuoc_tinhs');
            $table->string('ten_hien_thi',50);
            $table->string('gia_tri')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gia_tri_thuoc_tinhs');
    }
};
