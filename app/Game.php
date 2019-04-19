<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function home(){
        return $this->belongsTo(Team::class, 'home_id', 'id');
    }

    public function away(){
        return $this->belongsTo(Team::class, 'away_id', 'id');
    }



}
