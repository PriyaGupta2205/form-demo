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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'Controller@show');
Route::get('/edit/{details_id}', 'Controller@viewEdit');
Route::post('/edit', 'Controller@editReg');
Route::get('/delete/{details_id}', 'Controller@rejectReg');
// Route::get('/tasks', 'Controller@exportCsv');
// Route::get('users/export/', 'Controller@export');