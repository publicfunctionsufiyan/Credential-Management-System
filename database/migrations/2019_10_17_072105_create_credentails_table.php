<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('API_KEY')->nullable();
            $table->string('secret')->nullable();
            $table->string('Private_Key')->nullable();
            $table->string('Public_Key')->nullable();
            $table->json('other_properties')->nullable();
            $table->timestamps();
        });

        Schema::table('credentails', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credentails');
    }
}
