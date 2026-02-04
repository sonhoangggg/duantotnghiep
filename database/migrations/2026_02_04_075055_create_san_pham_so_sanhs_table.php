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
        Schema::create('san_pham_so_sanhs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_phams');
            $table->foreignId('bien_the_id')->nullable()->constrained('bien_the_san_phams');
            $table->foreignId('nguoi_dung_id')->nullable()->constrained('nguoi_dungs');
            $table->string('session_id')->nullable();
            $table->unique(['nguoi_dung_id', 'san_pham_id', 'bien_the_id']);
            $table->unique(['session_id', 'san_pham_id', 'bien_the_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham_so_sanhs');
    }
};
