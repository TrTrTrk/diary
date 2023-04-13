<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InputController;
use App\Http\Controllers\MakeAndDispController;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class,'main'])->name('main');
Route::get('/input', [InputController::class, 'input'])->middleware('auth')->name('input'); // Route::get('/input', 'App\Http\Controllers\InputController@input');
Route::post('/make-disp', [MakeAndDispController::class, 'makepic'])->middleware('auth')->name('make-disp'); // Route::post('/submit', 'App\Http\Controllers\InputController@submit');
Route::get('/disp', [MakeAndDispController::class, 'disp'])->name('disp'); // Route::post('/submit', 'App\Http\Controllers\InputController@submit');
Route::get('/delete', [MakeAndDispController::class, 'delete'])->name('delete'); // Route::post('/submit', 'App\Http\Controllers\InputController@submit');
Route::get('/confirm', [MakeAndDispController::class, 'create'])->name('confirm'); // Route::post('/submit', 'App\Http\Controllers\InputController@submit');
Route::get('/cancel', [MakeAndDispController::class, 'cancel'])->name('cancel'); // Route::post('/submit', 'App\Http\Controllers\InputController@submit');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\MainController::class, 'main'])->name('main');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
