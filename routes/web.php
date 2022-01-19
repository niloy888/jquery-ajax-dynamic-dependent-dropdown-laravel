<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
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


Route::get('/countries', [CountryController::class, 'index']);
Route::post('/ajax-get-cities', [CountryController::class, 'getCities'])->name('ajax-get-cities');
Route::post('/ajax-get-areas', [CountryController::class, 'getAreas'])->name('ajax-get-areas');
Route::post('/country/', [CountryController::class, 'submitData'])->name('submitData');
