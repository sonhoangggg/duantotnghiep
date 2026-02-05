<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DanhMuc;
class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DanhMuc::create([
                'ten'       => 'Danh mục ' . $i,
                'slug'      => 'danh-muc-' . $i,
                'logo'      => 'logo-' . $i . '.png',
                'mo_ta'     => 'Mô tả danh mục ' . $i,
                'parent_id' => null
            ]);
        }
    }
}
