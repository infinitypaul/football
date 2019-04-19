<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('home_id')->index();
            $table->unsignedBigInteger('season_id')->index();
            $table->unsignedBigInteger('home_goal')->default(0);
            $table->unsignedBigInteger('away_goal')->default(0);
            $table->unsignedBigInteger('away_id')->index();
            $table->string('referee');
            $table->integer('week');
            $table->boolean('played')->default(false);
            $table->date('date_played');
            $table->time('time_played');
            $table->timestamps();

            $table->foreign('home_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('away_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
