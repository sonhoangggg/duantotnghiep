<?php

namespace Database\Seeders;

use App\Models\ThongSo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThongSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten' => 'Kích thước màn hình', 'don_vi' => 'inch'],
            ['ten' => 'Độ phân giải', 'don_vi' => null],
            ['ten' => 'Công nghệ màn hình', 'don_vi' => null],
            ['ten' => 'Chip xử lý', 'don_vi' => null],
            ['ten' => 'RAM', 'don_vi' => 'GB'],
            ['ten' => 'Bộ nhớ trong', 'don_vi' => 'GB'],
            ['ten' => 'Camera sau', 'don_vi' => 'MP'],
            ['ten' => 'Camera trước', 'don_vi' => 'MP'],
            ['ten' => 'Dung lượng pin', 'don_vi' => 'mAh'],
            ['ten' => 'Sạc nhanh', 'don_vi' => 'W'],
        ];

        ThongSo::insert($data);
    }
}
