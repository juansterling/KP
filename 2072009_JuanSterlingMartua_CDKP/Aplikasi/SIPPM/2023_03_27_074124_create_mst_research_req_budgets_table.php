<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstResearchReqBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_research_req_mandatory_output', function (Blueprint $table) {
            $table->unsignedInteger("research_scheme_id")->primary();
            $table->foreign("research_scheme_id")->references("id")->on("mst_research_schemes");
            $table->float("min_budget")->default(0);
            $table->float("max_budget")->nullable();
            $table->integer("lead_ejm")->nullable();
            $table->integer("member_ejm")->nullable();
            $table->integer("ejm_period")->nullable();
            $table->string("ejm_period_type")->nullable();
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
        Schema::dropIfExists('mst_research_req_mandatory_output');
    }
}
