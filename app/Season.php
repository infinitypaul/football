<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function team()
    {
        return $this->hasMany(Team::class);
    }

    public function standing()
    {
        return $this->hasMany(Standing::class);
    }

    public function game()
    {
        return $this->hasMany(Game::class);
    }
}
