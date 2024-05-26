<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/threads', [ThreadController::class, 'index']);
Route::get('/threads/create', [ThreadController::class, 'create']);
Route::get('/threads/{channel}/{thread}', [ThreadController::class, 'show']);
Route::post('/threads', [ThreadController::class, 'store']);

// Route::resource([ThreadController::class]);
Route::get('/threads/{thread}/replies', [ReplyController::class, 'index']);
Route::post('/threads/{channel}/{thread}/replies', [ReplyController::class, 'store']);
