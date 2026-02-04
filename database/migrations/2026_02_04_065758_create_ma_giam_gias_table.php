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
        Schema::create('ma_giam_gias', function (Blueprint $table) {
            $table->id();
            $table->string('ma',50)->unique();
            $table->string('mo_ta')->nullable();
            $table->enum('loai',['phan_tram','co_dinh']);
            $table->decimal('gia_tri',15,0);
            $table->decimal('don_toi_thieu',15,0)->default(0);
            $table->integer('so_luong');
            $table->integer('da_su_dung')->default(0);
            $table->timestamp('ngay_bat_dau')->nullable();
            $table->timestamp('ngay_ket_thuc')->nullable();
            $table->enum('trang_thai',['an','hien'])->default('an');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gias');
    }
};
