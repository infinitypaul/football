<?php

namespace App\Http\Controllers;

use App\Season;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seasons = Season::orderBy('id')->take(10)->get();
        //dd(lowScore());
        return view('home', compact('seasons'));
    }

}
