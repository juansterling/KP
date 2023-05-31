<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('films_details')->insert([
            "film_id"=>"1",
            "jadwal_rilis"=>"3/2/2023",
            "bahasa"=>"Indonesia",
        ]);

        //
    }
}
