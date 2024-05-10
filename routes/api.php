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

// Authentication routes

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');

});

// BookController routes

Route::get('books',[BookController::class,'index'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::post('books',[BookController::class,'store'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::put('books/{id}',[BookController::class,'update'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::get('books/{id}',[BookController::class,'show'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::delete('books/{id}',[BookController::class,'destroy'])->middleware(['log_request', 'authorize_user','transaction_manager']);
// Route::post('books/borrowBook/{id}',[BookController::class,'borrowBook'])->middleware(['log_request', 'authorize_user','transaction_manager']);
// Route::post('books/{id}',[BookController::class,'returnedBook'])->middleware(['log_request', 'authorize_user','transaction_manager']);


// AuthorController routes


Route::get('authors',[AuthorController::class,'index'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::post('authors',[AuthorController::class,'store'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::put('authors/{id}',[AuthorController::class,'update'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::get('authors/{id}',[AuthorController::class,'show'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::delete('authors/{id}',[AuthController::class,'destroy'])->middleware(['log_request', 'authorize_user','transaction_manager']);


// ReviewsControler routes
Route::get('/reviews',[ReviewController::class, 'index'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::post('/add-book-review/{book}',[ReviewController::class, 'storeBookReview'])->middleware(['log_request', 'authorize_user','transaction_manager']);
Route::post('/add-author-review/{auhor}',[ReviewController::class, 'storeAuthorReview'])->middleware(['log_request', 'authorize_user','transaction_manager']);





