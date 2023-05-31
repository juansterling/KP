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
        Schema::create('studios_films', function (Blueprint $table) {
            $table->unsignedInteger("studio_id")->index();
            $table->foreign("studio_id")->references("id")->on("studios");
            $table->unsignedInteger("film_id")->index();
            $table->foreign("film_id")->references("id")->on("films");
            $table->timestamps();
            $table->primary(["studio_id","film_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studios_films');
    }
};
