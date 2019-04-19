<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests\SeasonRequest;
use App\Season;
use App\Standing;
use App\Transformers\SeasonTransformer;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('season');
    }

    public function createSeason(SeasonRequest $request){
        $season = new Season();
        $season->title = $request->seasons;
        $season->save();
        return redirect()->route('team', $season);
    }

    public function getSession($id){
        //$stand = Standing::get()->groupBy(['week']);
        //return $stand;
        $season = Season::find($id);
        if($season->standing){
            return fractal()
                ->item($season)
                ->parseIncludes(['game.home', 'game.away', 'league.team'])
                ->transformWith(new SeasonTransformer())
                ->toArray();
        }
        return 'No Standing';
    }
}
