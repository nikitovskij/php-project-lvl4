<?php

use Illuminate\Support\Facades\Route;
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
    Rollbar::log('info', 'Test debug message');
    return view('welcome');
});

Route::get('/rollbar', function () {
    return \Log::debug('Test debug message: rollbar');
});
