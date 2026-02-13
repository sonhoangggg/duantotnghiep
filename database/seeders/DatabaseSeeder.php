<?php

namespace Database\Seeders;

use App\Models\SanPham;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            // DanhMucBaiVietSeeder::class,
            VaiTroSeeder::class,
            NguoiDungSeeder::class,
            // BaiVietSeeder::class,
            // BinhLuanBaiVietSeeder::class,
            DanhMucSeeder::class,
            ThuongHieuSeeder::class,
            // SanPhamSeeder::class,
            // SanPhamDanhMucSeeder::class,
            // BienTheSanPhamSeeder::class,
            // ThuocTinhSeeder::class,
            // GiaTriThuocTinhSeeder::class,
            // BienTheThuocTinhSeeder::class,
            ThongSoSeeder::class,
            // SanPhamThongSoSeeder::class,
            // BienTheThongSoSeeder::class,
            // GioHangSoSeeder::class,
        ]);

    }
}
