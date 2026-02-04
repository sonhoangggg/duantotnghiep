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
        Schema::create('hoan_tras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('don_hangs');
            $table->string('ly_do');
            $table->enum('trang_thai',['cho_duyet','dong_y','tu_choi','hoan_thanh','huy'])->default('cho_duyet');
            $table->decimal('tong_tien_hoan',15,0);
            $table->string('ghi_chu_admin')->nullable();
            $table->timestamp('ngay_yeu_cau');
            $table->timestamp('ngay_xu_ly')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoan_tras');
    }
};
