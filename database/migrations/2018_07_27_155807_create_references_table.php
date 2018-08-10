<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cv_id');
            $table->string('name');
            $table->string('designation');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('organization');
            $table->string('phone_off')->nullable();
            $table->string('phone_res')->nullable();
            $table->char('address')->nullable();
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
        Schema::dropIfExists('references');
    }
}
