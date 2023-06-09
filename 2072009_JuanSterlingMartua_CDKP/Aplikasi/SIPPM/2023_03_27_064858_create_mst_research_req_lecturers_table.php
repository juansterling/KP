<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstResearchReqLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_research_req_lecturers', function (Blueprint $table) {
            $table->unsignedInteger("research_scheme_id")->primary();
            $table->foreign("research_scheme_id")->references("id")->on("mst_research_schemes");
            $table->string("lecturer_reqs")->nullable();
            $table->integer("min_lecturer")->default(0);
            $table->integer("max_lecturer")->nullable();
            $table->unsignedInteger("min_lead_position_id")->nullable();
            $table->unsignedInteger("max_lead_position_id")->nullable();
            $table->string("min_lead_position_strata")->nullable();
            $table->string("max_lead_position_strata")->nullable();
            $table->integer("maximum_age")->nullable();
            $table->integer("min_member")->default(0);
            $table->unsignedInteger("min_member_position_id")->nullable();
            $table->string("min_member_position_strata")->nullable();
            $table->integer("min_partner")->default(0);
            $table->unsignedInteger("min_partner_position_id")->nullable();
            $table->string("min_partner_position_strata")->nullable();
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
        Schema::dropIfExists('mst_research_req_lecturers');
    }
}
