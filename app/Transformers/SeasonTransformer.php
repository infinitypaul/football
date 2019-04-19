<?php

namespace App\Transformers;

use App\Season;
use League\Fractal\TransformerAbstract;

class SeasonTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    protected $availableIncludes = ['game', 'league'];
    public function transform(Season $season)
    {
        return [
            'title' => $season->title
        ];
    }

        public function includeGame(Season $season){
        return $this->collection($season->game, new GameTransformer());
        }

    public function includeLeague(Season $season){
        return $this->collection($season->standing, new StandingTransformer());
    }

}
