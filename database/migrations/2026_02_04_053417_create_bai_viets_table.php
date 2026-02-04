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
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->string('slug',100)->unique();
            $table->string('anh_dai_dien')->nullable();
            $table->string('mo_ta_ngan');
            $table->text('noi_dung');
            $table->foreignId('danh_muc_id')->constrained('danh_muc_bai_viets');
            $table->foreignId('nguoi_tao')->constrained('nguoi_dungs');
            $table->integer('luot_xem')->default(0);
            $table->enum('trang_thai',['hien_thi','an'])->default('an');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viets');
    }
};
