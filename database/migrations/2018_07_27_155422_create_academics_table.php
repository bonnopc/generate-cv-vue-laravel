<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cv_id');
            $table->string('level_of_educaton');
            $table->string('degree_title');
            $table->string('major');
            $table->string('institute');
            $table->string('result_type');
            $table->string('cgpa')->nullable();
            $table->string('scale')->nullable();
            $table->string('division')->nullable();
            $table->year('passing_year');
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('academics');
    }
}
