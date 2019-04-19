<?php

namespace App\Http\Controllers;

use App\Season;
use App\Standing;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public $lowScore;
    public $highScore;

    public function __construct()
    {
        $this->middleware('auth');
        $this->lowScore = lowScore();
        $this->highScore = highScore();
    }

    public function moveToNextWeek(Season $season, Request $request){
        //dd($season->game->sum('played'));
        if($season->game->sum('played') >= 12){
            return false;
        }
        $games  = $season->game()->where([['week', $request->week],['played', 0]])->get();
        //dd($games);
        foreach ($games as $game){
            $homeStrength = $game->home->strength;
            $awayStrength = $game->away->strength;

            if($homeStrength > $awayStrength){
                $game->home_goal  = $this->highScore;
                $game->away_goal = $this->lowScore;
                $won = 'home';
            } else {
                $game->home_goal  = $this->lowScore;
                $game->away_goal = $this->highScore;
                $won = 'away';
            }
            $game->played= 1;
            $game->save();
            //dd($game->home->standing);
            if(!is_null($game->home->standing)){
                $away = $game->away->standing()->latest()->first();
                $this->updateStanding($away, $season->id, $request->week, $won, 'away');

                $home = $game->home->standing()->latest()->first();
                $this->updateStanding($home, $season->id, $request->week, $won, 'home');
            }else {
                $this->enterStanding($game, $season->id, $request->week, $won, 'home');
                $this->enterStanding($game, $season->id, $request->week, $won, 'away');
            }

        }
    }

    protected function enterStanding($game, $seasonId, $week, $won, $club){
        $standing = new Standing();
        $standing->team_id = $game->{$club.'_id'};
        $standing->season_id = $seasonId;
        $standing->week = $week;
        $standing->pts = $won == $club ? 3 : 0;
        $standing->w = $won == $club ? 1 : 0;
        $standing->d = 0;
        $standing->p = 1;
        $standing->l = $won != $club ? 1 : 0;
        $standing->gd = $won === $club ? $this->highScore-$this->lowScore : $this->lowScore-$this->highScore;
        $standing->save();
    }

    protected function updateStanding($away, $seasonId, $week, $won, $club){
        $standing = new Standing();
        $standing->team_id = $away->team_id;
        $standing->season_id = $seasonId;
        $standing->week = $week;
        $standing->p = $away->p+1;
        $standing->pts = $won == $club ? $away->pts+3 : $away->pts;
        $standing->w = $won == $club ? $away->w+1 : $away->w;
        $standing->l = $won != $club ? $away->l+1 : $away->l;
        $standing->d = 0;
        $standing->gd = $won === $club ? $away->gd+($this->highScore-$this->lowScore) : $away->gd+($this->lowScore-$this->highScore);
        $standing->save();
    }
}
