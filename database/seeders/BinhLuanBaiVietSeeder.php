<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BinhLuanBaiViet;
class BinhLuanBaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            BinhLuanBaiViet::create([
                'bai_viet_id'   => $i,
                'nguoi_dung_id' => $i,
                'ten_khach'     => 'Khách ' . $i,
                'email_khach'   => 'khach' . $i . '@gmail.com',
                'noi_dung'      => 'Nội dung bình luận số ' . $i,
                'parent_id'     => null
            ]);
        }
    }
}
