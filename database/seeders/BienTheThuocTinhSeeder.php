<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BienTheThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            // Thuộc tính MÀU
            DB::table('bien_the_thuoc_tinhs')->insert([
                'bien_the_id'  => $i,
                'thuoc_tinh_id'=> 1, // Màu sắc
                'gia_tri_id'   => rand(1, 10),
            ]);

            // Thuộc tính DUNG LƯỢNG
            DB::table('bien_the_thuoc_tinhs')->insert([
                'bien_the_id'  => $i,
                'thuoc_tinh_id'=> 2, // Dung lượng
                'gia_tri_id'   => rand(11, 20),
            ]);
        }
    }
}
