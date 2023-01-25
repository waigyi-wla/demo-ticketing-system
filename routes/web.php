<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('tickets', [TicketsController::class, 'index']);
Route::get('new-ticket', [TicketsController::class, 'create']);
Route::post('new-ticket', [TicketsController::class, 'store']);
Route::get('tickets/{code}', [TicketsController::class, 'show']);

Route::post('comment', [CommentsController::class, 'postComment']);

Route::group(['middleware' => 'admin'], function (){
    Route::get('/tickets/close/{code}', [TicketsController::class, 'close']);
    Route::get('/tickets/edit/{code}', [TicketsController::class, 'edit']);
    Route::post('/tickets/update', [TicketsController::class, 'update']);

    Route::get('/users', [UsersController::class, 'index']);
    Route::get('new-user', [UsersController::class, 'create']);
    Route::post('new-user', [UsersController::class, 'store']);

    Route::get('/categories', [CategoriesController::class, 'index']);
});