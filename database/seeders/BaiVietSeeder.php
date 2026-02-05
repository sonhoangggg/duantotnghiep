<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BaiViet;
class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            BaiViet::create([
                'tieu_de'      => 'Bài viết số ' . $i,
                'slug'         => 'bai-viet-so-' . $i,
                'anh_dai_dien' => 'bai-viet-' . $i . '.jpg',
                'mo_ta_ngan'   => 'Mô tả ngắn bài viết số ' . $i,
                'noi_dung'     => 'Nội dung chi tiết bài viết số ' . $i,
                'danh_muc_id'  => $i,
                'nguoi_tao'    => $i,
                'luot_xem'     => 0,
                'trang_thai'   => 'hien_thi',
            ]);
        }
    }
}
