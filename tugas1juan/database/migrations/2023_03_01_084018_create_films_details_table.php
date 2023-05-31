<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films_details', function (Blueprint $table) {            
            $table->unsignedInteger("film_id")->primary();
            $table->foreign("film_id")->references("id")->on("films");
            $table->date("jadwal_rilis");
            $table->string("bahasa");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films_details');
    }
};
