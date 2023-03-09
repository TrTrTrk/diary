<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\MainController@main');

Route::get('input', 'App\Http\Controllers\InputController@input');

Route::post('submit', 'App\Http\Controllers\InputController@submit');

// Route::get('/', function () {
//     return view('welcome');
// });