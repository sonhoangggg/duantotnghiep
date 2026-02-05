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
            $table->id();

            $table->foreignId('gio_hang_id')->constrained('gio_hangs')->cascadeOnDelete();
            $table->foreignId('san_pham_id')->constrained('san_phams')->cascadeOnDelete();
            $table->foreignId('bien_the_id')->nullable()->constrained('bien_the_san_phams')->nullOnDelete();

            $table->integer('so_luong');
            $table->timestamps();

            $table->unique(
                ['gio_hang_id', 'san_pham_id', 'bien_the_id'],
            );
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
