<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@index')->name('league');

Route::get('/season', 'SeasonController@index')->name('season');
Route::post('/season', 'SeasonController@createSeason');

Route::get('/getseason/{id}', 'SeasonController@getSession');


Route::get('/team/{season}', 'TeamController@index')->name('team');
Route::post('/team/{season}', 'TeamController@createTeam');

Route::post('/nextmove/{season}', 'FixtureController@moveToNextWeek');
