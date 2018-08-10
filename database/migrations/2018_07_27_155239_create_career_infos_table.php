<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cv_id');
            $table->char('objective')->nullable();
            $table->char('career_summary')->nullable();
            $table->char('special_qualification')->nullable();
            $table->unsignedInteger('present_salary')->nullable();
            $table->unsignedInteger('expected_salary')->nullable();
            $table->string('expected_job_level')->nullable();
            $table->string('available_for')->nullable();
            $table->text('preferred_job_categories')->nullable();
            $table->text('preferred_job_locations')->nullable();
            $table->text('skills')->nullable();
            $table->char('skills_desc')->nullable();
            $table->char('extra_curricular_activities')->nullable();
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_infos');
    }
}
