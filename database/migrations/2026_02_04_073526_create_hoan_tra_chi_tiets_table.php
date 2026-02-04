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
        Schema::create('hoan_tra_chi_tiets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoan_tra_id')->constrained('hoan_tras');
            $table->foreignId('chi_tiet_don_hang_id')->unique()->constrained('chi_tiet_don_hangs');
            $table->integer('so_luong_hoan');
            $table->decimal('gia',15,0);
            $table->decimal('thanh_tien',15,0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoan_tra_chi_tiets');
    }
};
