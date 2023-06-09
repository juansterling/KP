<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstResearchReqOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_research_req_outputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("research_scheme_id");
            $table->foreign("research_scheme_id")->references("id")->on("mst_research_schemes");
            $table->unsignedInteger("output_id");
            $table->foreign("output_id")->references("id")->on("mst_outputs");
            $table->string("category");
            $table->string("output_title");
            $table->string("min_grade")->nullable();
            $table->string("max_grade")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_research_req_outputs');
    }
}
