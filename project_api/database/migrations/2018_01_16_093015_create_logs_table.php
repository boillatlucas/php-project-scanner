<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20);
            $table->string('status', 50)->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('log_type_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::create('log_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 100);
        });
        Schema::create('log_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('log_id')->unsigned()->nullable();
        });

        Schema::table('logs', function(Blueprint $table)
        {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('log_type_id')->references('id')->on('log_types')->onDelete('set null');
        });
        Schema::table('log_lines', function(Blueprint $table)
        {
            $table->foreign('log_id')->references('id')->on('logs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('log_types');
        Schema::dropIfExists('log_lines');
    }
}
