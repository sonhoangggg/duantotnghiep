<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SanPhamDanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('san_pham_danh_mucs')->insert([
                'san_pham_id' => $i,
                'danh_muc_id' => $i,
            ]);
        }
    }
}
