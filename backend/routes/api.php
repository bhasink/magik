<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/conatct', array( 'uses' => 'ContactController@AddConatact'));
Route::post('/gift', array( 'uses' => 'ContactController@Gift'));
Route::post('/check', array( 'uses' => 'ContactController@Check'));
Route::post('/update', array( 'uses' => 'ContactController@GiftUpdate'));
Route::get('/state', array( 'uses' => 'ContactController@StateList'));

Route::get('/term', array( 'uses' => 'ContactController@termConditions'));
Route::get('/generatecsv', array( 'uses' => 'ContactController@generateCSV'));
Route::get('/report', array( 'uses' => 'ContactController@DaySummary'));
Route::get('/getcampaign', array( 'uses' => 'ContactController@getCampaign'));
Route::get('/testc', array( 'uses' => 'ContactController@test'));
Route::get('/generateweeklycsv', array( 'uses' => 'ContactController@generateWeeklyCsv'));
Route::get('/weeklyreport', array( 'uses' => 'ContactController@WeeklySummaryReport'));