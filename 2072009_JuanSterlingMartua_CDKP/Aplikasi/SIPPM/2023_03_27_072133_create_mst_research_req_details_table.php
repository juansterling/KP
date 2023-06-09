<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstResearchReqDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_research_req_details', function (Blueprint $table) {
            $table->unsignedInteger("research_scheme_id")->primary();
            $table->foreign("research_scheme_id")->references("id")->on("mst_research_schemes");
            $table->integer("min_mandatory_output")->default(0);
            $table->integer("min_student")->default(0);
            $table->integer("max_student")->nullable();
            $table->string("disciplines")->nullable();
            $table->float("student_transport_cost")->nullable();
            $table->string("student_transport_period")->nullable();
            $table->integer("waiting_period")->nullable();
            $table->string("waiting_span")->nullable();
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
        Schema::dropIfExists('mst_research_req_details');
    }
}
