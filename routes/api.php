<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');

});

Route::get('books',[BookController::class,'index'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::post('books',[BookController::class,'store'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::put('books/{id}',[BookController::class,'update'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::get('books/{id}',[BookController::class,'show'])->middleware(['log_request', 'authorize_user','transaction_manager']);

Route::get('authors',[AuthorController::class,'index'])->name('authors');

Route::get('reviews',[ReviewController::class,'index'])->name('reviews');
