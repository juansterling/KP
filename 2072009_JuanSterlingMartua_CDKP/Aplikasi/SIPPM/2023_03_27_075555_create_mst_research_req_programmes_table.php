<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstResearchReqProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_research_req_programmes', function (Blueprint $table) {
            $table->unsignedInteger("research_scheme_id")->index();
            $table->foreign("research_scheme_id")->references("id")->on("mst_research_schemes");
            $table->unsignedInteger("student_programme_id")->index();
            $table->foreign("student_programme_id")->references("id")->on("mst_student_programmes");
            $table->timestamps();
            $table->softDeletes();
            $table->primary(["research_scheme_id","student_programme_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_research_req_programmes');
    }
}
