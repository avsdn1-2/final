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
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/list',[\App\Http\Controllers\CityController::class,'index'])->name('cities.list');
Route::get('/update/{code}',[\App\Http\Controllers\CityController::class,'update'])->name('city.update');

//Route::get('/weather/{code}', [\App\Http\Controllers\WeatherController::class, 'fetch'])->name('weather.get');
Route::get('/weather', [\App\Http\Controllers\WeatherController::class, 'fetch'])->name('weather.get');
//Route::get('/list', [\App\Http\Controllers\WeatherController::class, 'list'])->name('weather.list');

require __DIR__.'/auth.php';
