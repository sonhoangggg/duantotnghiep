<?php

namespace Database\Seeders;

use App\Models\GioHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GioHangSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            GioHang::create([
                'nguoi_dung_id' => $i,
            ]);
        }
    }
}
