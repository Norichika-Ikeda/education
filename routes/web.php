<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CurriculumProgressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
    ['middleware' => ['auth']],
    function () {
        /* ログイン時のみアクセス可能なルートはこの中に記述する。 */
        Route::get('/top', [ArticleController::class, 'top']);

        Route::get('/article', [ArticleController::class, 'article']);
        Route::get('/timetable', [CurriculumController::class, 'timetable']);
        Route::get('/progress', [CurriculumProgressController::class, 'progress']);
        Route::get('/profile', [UserController::class, 'profile']);
    }
);
