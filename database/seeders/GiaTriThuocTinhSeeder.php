<?php

namespace Database\Seeders;

use App\Models\GiaTriThuocTinh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GiaTriThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            GiaTriThuocTinh::create([
                'thuoc_tinh_id' => 1,
                'ten_hien_thi'  => 'Màu ' . $i,
                'gia_tri'       => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            GiaTriThuocTinh::create([
                'thuoc_tinh_id' => 2,
                'ten_hien_thi'  => 'Ram ' . $i,
            ]);
        }
    }
}
