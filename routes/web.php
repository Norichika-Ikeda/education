<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CurriculumProgressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware('auth:user')->group(
    function () {
        Route::get('/top', [ArticleController::class, 'top'])->name('top');

        Route::get('/articles/{id}', [ArticleController::class, 'article'])->name("article");
        Route::get('/timetable', [CurriculumController::class, 'timetable'])->name('timetable');
        Route::get('/prev_timetable', [CurriculumController::class, 'prevMonthTimetable'])->name('prev_month_timetable');
        Route::get('/timetable/{next_month}', [CurriculumController::class, 'nextMonthTimetable'])->name('next_month_timetable');
        Route::get('/progress', [CurriculumProgressController::class, 'progress'])->name('progress');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    }
);
