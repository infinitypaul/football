<?php

namespace App\Transformers;

use App\Game;
use League\Fractal\TransformerAbstract;

class GameTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    protected $availableIncludes = ['home','away'];

    public function transform(Game $game)
    {
        return [
            'home_goal' => $game->home_goal,
            'away_goal' => $game->away_goal,
            'played' => $game->played,
            'week' => $game->week,
            'ref' => ucwords($game->referee),
            'date_played' => $game->date_played.' - '.$game->time_played
        ];


    }

    public function includeHome(Game $game){
        return $this->item($game->home, new TeamTransformer());
    }

    public function includeAway(Game $game){
        return $this->item($game->away, new TeamTransformer());
    }
}
