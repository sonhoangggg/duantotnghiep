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
        Schema::create('san_pham_thuoc_tinhs', function (Blueprint $table) {
            $table->foreignId('san_pham_id')->constrained('san_phams');
            $table->foreignId('thuoc_tinh_id')->constrained('thuoc_tinhs');
            $table->primary(['san_pham_id', 'thuoc_tinh_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham_thuoc_tinhs');
    }
};
