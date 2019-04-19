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
            $table->unsignedBigInteger('home_goal')->index();
            $table->unsignedBigInteger('away_goal')->index();
            $table->unsignedBigInteger('away_id')->index();
            $table->boolean('played')->default(false);
            $table->date('date_played');
            $table->timestamps();

            $table->foreign('home_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('away_id')->references('id')->on('teams')->onDelete('cascade');
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
