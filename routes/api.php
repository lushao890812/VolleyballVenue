<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('todolist', 'App\Http\Controllers\TodolistController@getEvent');
Route::post('todolist', 'App\Http\Controllers\TodolistController@addEvent');
Route::put('todolist', 'App\Http\Controllers\TodolistController@updateEvent');
Route::delete('todolist', 'App\Http\Controllers\TodolistController@deleteEvent');

Route::get('volleyball_session', 'App\Http\Controllers\Volleyball_sessionController@getData');

Route::get('venue', 'App\Http\Controllers\VenueController@getVenue');
Route::post('venue', 'App\Http\Controllers\VenueController@addVenue');
Route::put('venue', 'App\Http\Controllers\VenueController@updateVenue');
Route::delete('venue', 'App\Http\Controllers\VenueController@deleteVenue');