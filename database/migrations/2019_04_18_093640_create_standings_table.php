<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('season_id')->index();
            $table->unsignedBigInteger('team_id')->index();
            $table->integer('week');
            $table->integer('p');
            $table->integer('w');
            $table->integer('d');
            $table->integer('l');
            $table->integer('gd');
            $table->timestamps();

            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standings');
    }
}
