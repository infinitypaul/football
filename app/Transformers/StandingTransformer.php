<?php

namespace App\Transformers;

use App\Standing;
use League\Fractal\TransformerAbstract;

class StandingTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    protected $availableIncludes = ['team'];
    public function transform(Standing $standing)
    {
        return [
            'pts' => $standing->pts,
            'p' => $standing->p,
            'w' => $standing->w,
            'd' => $standing->d,
            'l' => $standing->l,
            'gd' => $standing->gd,
            'week' => $standing->week
        ];
    }

    public function includeTeam(Standing $standing){
        return $this->item($standing->team, new TeamTransformer());
    }
}
