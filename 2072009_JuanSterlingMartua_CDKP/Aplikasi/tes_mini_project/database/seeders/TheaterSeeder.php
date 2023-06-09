<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('theaters')->insert([
            "nama_bioskop"=>"CGV TSM",
            "kota"=>"Bandung",
            "jumlah_studio"=>0,
        ]);
        DB::table('theaters')->insert([
            "nama_bioskop"=>"XXI TSM",
            "kota"=>"Bandung",
            "jumlah_studio"=>0,
        ]);
        DB::table('theaters')->insert([
            "nama_bioskop"=>"Asik",
            "kota"=>"Bandung",
            "jumlah_studio"=>0,
        ]);

    }
}
