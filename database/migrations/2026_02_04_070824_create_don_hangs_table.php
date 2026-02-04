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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang',50)->unique();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dungs');
            $table->string('ho_ten',150)->nullable();
            $table->string('email')->nullable();
            $table->string('so_dien_thoai',15)->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('phuong_xa',100)->nullable();
            $table->string('quan_huyen',100)->nullable();
            $table->string('tinh_thanh',100)->nullable();
            $table->decimal('tong_tien',15,0);
            $table->decimal('phi_van_chuyen',15,0)->default(0);
            $table->decimal('giam_gia',15,0)->default(0);
            $table->decimal('tong_thanh_toan',15,0)->default(0);
            $table->enum('trang_thai',['cho_xac_nhan','da_xac_nhan','dang_giao','da_giao','huy','hoan_tra'])->default('cho_xac_nhan');
            $table->enum('phuong_thuc_thanh_toan',['cod','chuyen_khoan','vi_dien_tu']);
            $table->enum('trang_thai_thanh_toan',['chua_thanh_toan','da_thanh_toan','hoan_tien'])->default('chua_thanh_toan');
            $table->string('ghi_chu')->nullable();
            $table->foreignId('ma_giam_gia_id')->nullable()->constrained('ma_giam_gias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
