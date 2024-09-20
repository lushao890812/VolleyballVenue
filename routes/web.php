<?php

use Illuminate\Support\Facades\Route;

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
    return view('venue_map');
})->name('venue');
Route::get('/edite_venue', function () {
    return view('edite_venue');
})->name('edite_venue');
Route::get('/todolist', function () {
    return view('todolist');
});
Route::get('/resume', function () {
    return view('resume');
});
Route::get('/volleyball_session', function () {
    return view('volleyball_session');
});
