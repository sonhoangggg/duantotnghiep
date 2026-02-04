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
        Schema::create('san_pham_thong_sos', function (Blueprint $table) {
            $table->foreignId('san_pham_id')->constrained('san_phams');
            $table->foreignId('thong_so_id')->constrained('thong_sos');
            $table->string('gia_tri', 255);
            $table->primary(['san_pham_id', 'thong_so_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham_thong_sos');
    }
};
