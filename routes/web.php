<?php

use Illuminate\Support\Facades\Route;
use Rollbar\Payload\Level;
use Rollbar\Rollbar;

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
    Rollbar::log(Level::DEBUG, \Log::debug('Test debug message: rollbar'));
    return view('welcome');
});
