<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigneds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('credentail_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->json('other_properties')->nullable();

            $table->timestamps();
        });
        // Schema::table('credentails', function($table) {
        //     $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        // });

        Schema::table('assigneds', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('credentail_id')->references('id')->on('credentails')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigneds');
    }
}
