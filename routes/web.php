<?php

use App\Http\Controllers\ImageController;
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

Route::get('/', [ImageController::class, 'index']);
Route::Post('/', [ImageController::class, 'upload']);
Route::get('snatch/{id}', [ImageController::class, 'snatch']);
Route::get('delete/{id}', [ImageController::class, 'delete']);

Route::get('all', [ImageController::class, 'all']);
