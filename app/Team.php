<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = ['id'];
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function standing()
    {
        return $this->hasOne(Standing::class);
    }


}
