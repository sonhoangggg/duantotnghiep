<?php

namespace Database\Seeders;

use App\Models\VaiTro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaiTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VaiTro::create([
            'ten' => 'nguoi_dung'
        ]);
        VaiTro::create([
            'ten' => 'nhan_vien'
        ]);
        VaiTro::create([
            'ten' => 'quan_tri'
        ]);
    }
}
