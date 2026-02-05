<?php

namespace Database\Seeders;
use App\Models\DanhMucBaiViet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhMucBaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DanhMucBaiViet::create([
                'ten'   => 'Bài viết ' . $i,
                'slug'  => 'bai-viet-' . $i,
                'mo_ta' => 'Danh mục bài viết ' . $i,
            ]);
        }
    }
}
