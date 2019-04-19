<?php

namespace App\Transformers;

use App\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Team $team)
    {
        return [
            'title' => $team->title,
            'strength' => $team->strength
        ];
    }
}
