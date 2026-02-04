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
        Schema::create('giao_dich_vis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vi_id')->constrained('vi_nguoi_dungs');
            $table->enum('loai_giao_dich',['nap','rut','thanh_toan','hoan']) ;
            $table->decimal('so_tien_giao_dich',15,0);
            $table->decimal('so_du_truoc',15,0);
            $table->decimal('so_du_sau',15,0);
            $table->string('mo_ta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giao_dich_vis');
    }
};
