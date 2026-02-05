<?php

namespace Database\Seeders;

use App\Models\BienTheSanPham;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BienTheSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            BienTheSanPham::create([
                'san_pham_id'   => rand(1,5),
                'sku'           => 'SP' . $i,
                'anh_bien_the'  => "bien-the/sp{$i}.jpg",
                'gia_goc'       => rand(10, 20) * 1_000_000,
                'gia_ban'       => rand(8, 18) * 1_000_000,
                'so_luong'      => rand(10, 100),
                'trang_thai'    => 'hien',
                'da_ban'        => rand(0, 20),
            ]);
        }
    }
}
