<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('films')->insert([
            "film"=>"Film1",
            "durasi"=>3,
            "rating"=>"SU",
            "sinopsis"=>"Film1 keren",
        ]);
    }
}
