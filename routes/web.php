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

Route::get('image', 'App\Http\Controllers\imagenes@index');
Route::post('uploadimage','App\Http\Controllers\imagenes@bg');
Route::post('redimensionar', 'App\Http\Controllers\imagenes@redimensionar');