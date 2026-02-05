<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ThuongHieu;

class ThuongHieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            ThuongHieu::create([
                'ten'   => 'Thương hiệu ' . $i,
                'slug'  => 'thuong-hieu-' . $i,
                'logo'  => 'thuong-hieu-' . $i . '.png',
                'mo_ta' => 'Mô tả thương hiệu ' . $i,
            ]);
        }
    }
}
