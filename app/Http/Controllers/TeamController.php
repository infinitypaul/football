<?php

namespace App\Http\Controllers;

use App\Game;
use App\Season;
use App\Standing;
use App\Team;
use Arr;
use DB;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Season $season){
        return view('createTeam', compact('season'));
    }

    public function createTeam(Season $season, Request $request){
        $data = [];
        $strength = [40, 30, 20, 10];
        $i = 0;
        foreach ($request->Club as $team){
            $data[] = ['title' => $team, 'strength' => $strength[$i]];
            $i++;
        }
        $season->team()->createMany($data);
        $teams = $season->team()->select('id')->take(4)->get();
        //$this->generateStanding($teams, $season->id);
        $team = Arr::flatten($teams->toArray());
        if($this->generateFixture($team, $season->id)){
            return redirect()->route('home')->with('success', 'Team Created Succesfully');
        };
    }

    protected function generateFixture($club, $id){
        $fixtures =  getFixtures($club, '', ['paul', 'eddy'], $id);
        foreach ($fixtures as $fixture){
            DB::table("games")->insert($fixture);
        }
        return true;
    }

    protected function generateStanding($teams, $id){
        //dd($teams);
        foreach($teams as $team){
            $standing = new Standing();
            $standing->team_id = $team->id;
            $standing->season_id = $id;
            $standing->save();
        }
    }
}
