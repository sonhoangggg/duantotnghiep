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
        Schema::create('bien_the_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_phams');
            $table->string('sku',100)->unique();
            $table->string('anh_bien_the')->nullable();
            $table->decimal('gia_goc',15,0);
            $table->decimal('gia_ban',15,0)->nullable();
            $table->integer('so_luong')->default(0);
            $table->enum('trang_thai',['an','hien'])->default('hien');
            $table->integer('da_ban')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_the_san_phams');
    }
};
