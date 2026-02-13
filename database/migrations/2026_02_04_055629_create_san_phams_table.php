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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('slug',100)->unique();
            $table->string('sku',100)->unique();
            $table->decimal('gia_goc',15,0)->nullable();
            $table->decimal('gia_ban',15,0)->nullable();
            $table->integer('so_luong')->nullable();
            $table->longText('mo_ta_ngan')->nullable();
            $table->longText('mo_ta_chi_tiet')->nullable();
            $table->string('anh_chinh');
            $table->enum('trang_thai',['an','hien'])->default('an');
            $table->enum('loai',['don','bien_the'])->default('don');
            $table->boolean('noi_bat')->default(false);
            $table->foreignId('thuong_hieu_id')->nullable()->constrained('thuong_hieus');
            $table->integer('luot_xem')->default(0);
            $table->integer('da_ban')->default(0);
            $table->foreignId('nguoi_tao')->constrained('nguoi_dungs');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
