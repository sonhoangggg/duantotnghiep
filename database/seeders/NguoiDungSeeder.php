<?php

namespace Database\Seeders;

use App\Models\NguoiDung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            NguoiDung::create([
                'ho_ten'        => 'Người dùng ' . $i,
                'ten_dang_nhap' => 'user' . $i,
                'email'         => 'user' . $i . '@gmail.com',
                'password'      => Hash::make('123456'),
                'so_dien_thoai' => '09000000' . $i,
                'anh_dai_dien'  => null,
                'dia_chi'       => 'Việt Nam',
                'trang_thai'    => 1,
                'vai_tro_id'    => 1, // người dùng
            ]);
        }
    }
}
