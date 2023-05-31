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
        Schema::create('studios', function (Blueprint $table) {
            $table->id();    
            $table->unsignedInteger("theater_id")->foreign()->references("id")->on("theaters");
            $table->foreign("theater_id")->references("id")->on("theaters");
            $table->string("jenis_studio");
            $table->integer("studio");
            $table->timestamps();
            $table->softDeletes();
            $table->unique(["theater_id","studio"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studios');
    }
};
