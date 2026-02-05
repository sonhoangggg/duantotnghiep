<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BienTheThongSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            // RAM
            DB::table('bien_the_thong_sos')->insert([
                'bien_the_id' => $i,
                'thong_so_id' => 5,
                'gia_tri'     => fake()->randomElement(['8', '12']),
            ]);

            // Bộ nhớ trong
            DB::table('bien_the_thong_sos')->insert([
                'bien_the_id' => $i,
                'thong_so_id' => 6,
                'gia_tri'     => fake()->randomElement(['256', '512']),
            ]);
        }

    }
}
