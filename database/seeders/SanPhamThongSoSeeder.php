<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SanPhamThongSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 10; $j++) {

                DB::table('san_pham_thong_sos')->insert([
                    'san_pham_id' => $i,
                    'thong_so_id' => $j,
                    'gia_tri'     => fake()->randomElement([
                        '12',
                        '64',
                        '128',
                        '256',
                        '512',
                        '6.7',
                        '5000'
                    ]),
                ]);

            }
        }
    }
}
