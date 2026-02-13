<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bien_the_san_phams', function (Blueprint $table) {
            $table->string('to_hop_gia_tri')->after('san_pham_id')->comment('Tổ hợp giá trị thuộc tính, ví dụ: M-Đỏ-64GB');
            $table->unique(['san_pham_id', 'to_hop_gia_tri'], 'unique_san_pham_to_hop_gia_tri');
        });
        DB::statement("
            ALTER TABLE bien_the_san_phams
            MODIFY trang_thai
            ENUM('an', 'hien', 'cap_nhap')
            default 'an'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bien_the_san_phams', function (Blueprint $table) {
            $table->dropColumn('to_hop_gia_tri');
            $table->dropUnique('unique_san_pham_to_hop_gia_tri');
        });
        DB::statement("
            ALTER TABLE bien_the_san_phams
            MODIFY trang_thai
            ENUM('an', 'hien', 'cap_nhap')
            default 'an'
        ");
    }
};
