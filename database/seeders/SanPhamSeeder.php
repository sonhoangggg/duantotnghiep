<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SanPham;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            SanPham::create([
                'ten'              => 'Sản phẩm ' . $i,
                'slug'             => 'san-pham-' . $i,
                'sku'              => 'SP00' . $i,
                'gia_goc'          => 1000000 + ($i * 100000),
                'gia_ban'          => 900000 + ($i * 100000),
                'so_luong'         => 100 + $i,
                'mo_ta_ngan'       => 'Mô tả ngắn sản phẩm ' . $i,
                'mo_ta_chi_tiet'   => 'Mô tả chi tiết sản phẩm ' . $i,
                'anh_chinh'        => 'san-pham-' . $i . '.jpg',
                'trang_thai'       => 'hien',
                'thuong_hieu_id'   => $i,
                'nguoi_tao'        => $i,
            ]);
        }
        for ($i = 6; $i <= 10; $i++) {
            SanPham::create([
                'ten'              => 'Sản phẩm ' . $i,
                'slug'             => 'san-pham-' . $i,
                'sku'              => 'SP00' . $i,
                'mo_ta_ngan'       => 'Mô tả ngắn sản phẩm ' . $i,
                'mo_ta_chi_tiet'   => 'Mô tả chi tiết sản phẩm ' . $i,
                'anh_chinh'        => 'san-pham-' . $i . '.jpg',
                'trang_thai'       => 'hien',
                'loai'             => 'bien_the',
                'thuong_hieu_id'   => $i,
                'nguoi_tao'        => $i,
            ]);
        }
    }
}
