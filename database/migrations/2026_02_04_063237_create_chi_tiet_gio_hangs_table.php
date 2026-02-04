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
        Schema::create('chi_tiet_gio_hangs', function (Blueprint $table) {
            $table->foreignId('gio_hang_id')->constrained('gio_hangs');
            $table->foreignId('san_pham_id')->constrained('san_phams');
            $table->unsignedBigInteger('bien_the_id')->default(0);
            $table->integer('so_luong');
            $table->primary(['gio_hang_id','san_pham_id','bien_the_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_gio_hangs');
    }
};
