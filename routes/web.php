<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Class_;

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

Route::get('/', function () {
    return view('index');
});
Route::post('processCsv', [Controller::class, 'processCsv'])->name('importCsv');
Route::get('processCsv', function(){
    return view('index');
});


Route::get('/csv', [Controller::class, 'processCsv']);