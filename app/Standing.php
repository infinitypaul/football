<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $guarded = ['id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function enterData($game, $seasonId, $week, $won, $club){
        $this->team_id = $game->{$club.'_id'};
        $this->season_id = $seasonId;
        $this->week = $week;
        $this->pts = $won == 'home' ? 3 : 0;
        $this->w = $won == 'home' ? 1 : 0;
        $this->d = 0;
        $this->p = 1;
        $this->l = $won != 'home' ? 1 : 0;
        $this->gd = $won === 'home' ? 3-2 : 2-3;
        $this->save();
    }
}
