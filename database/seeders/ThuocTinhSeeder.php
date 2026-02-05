<?php

namespace Database\Seeders;

use App\Models\ThuocTinh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThuocTinh::create([
            'ten' => 'mau',
            'kieu'=> 'mau'
        ]);
        ThuocTinh::create([
            'ten' => 'Dung Lượng',
            'kieu'=> 'chuoi'
        ]);
    }
}
