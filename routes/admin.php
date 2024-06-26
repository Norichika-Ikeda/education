<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryTimeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
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



Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin_login_form');
Route::get('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin_register_form');

Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin_login');
Route::post('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'adminRegister'])->name('admin_register');
Route::post('/admin/logout', [\App\Http\Controllers\Auth\LoginController::class, 'adminLogout'])->name('admin_logout');

Route::prefix('admin')->middleware('auth:admin')->group(
    function () {
        Route::get('top', [ArticleController::class, 'adminTop'])->name("admin_top");

        Route::get('curriculum_management/{id}', [CurriculumController::class, 'showCurriculumManagement'])->name('curriculum_management');

        Route::get('curriculum_create', [CurriculumController::class, 'curriculumCreateForm'])->name('curriculum_create_form');

        Route::post('curriculum_create', [CurriculumController::class, 'curriculumCreate'])->name('curriculum_create');

        Route::get('curriculum_edit/{id}', [CurriculumController::class, 'curriculumEditForm'])->name('curriculum_edit_form');

        Route::post('curriculum_edit', [CurriculumController::class, 'curriculumEdit'])->name('curriculum_edit');

        Route::get('/delivery_time_setting/{id}', [DeliveryTimeController::class, 'deliveryTimeForm'])->name('delivery_time_form');

        Route::post('/delivery_time_setting', [DeliveryTimeController::class, 'deliveryTimeEdit'])->name('delivery_time_edit');

        Route::delete('/delivery_time_delete/{id}', [DeliveryTimeController::class, 'deliveryTimeDelete'])->name('delivery_time_delete');

        Route::get('/delivery_time_add', [DeliveryTimeController::class, 'deliveryTimeAdd'])->name('delivery_time_add');

        Route::get('/article_management', [ArticleController::class, 'showArticleManagement'])->name('article_management');

        Route::get('/article_create', [ArticleController::class, 'articleCreateForm'])->name('article_create_form');

        Route::post('/article_create', [ArticleController::class, 'articleCreate'])->name('article_create');

        Route::get('/article_edit/{id}', [ArticleController::class, 'articleEditForm'])->name('article_edit_form');

        Route::post('/article_edit', [ArticleController::class, 'articleEdit'])->name('article_edit');

        Route::delete('/article_delete/{id}', [ArticleController::class, 'articleDelete'])->name('article_delete');

        Route::get('/banner_management', [BannerController::class, 'showBannerManagement'])->name('banner_management');

        Route::post('/banner_setting', [BannerController::class, 'bannerEdit'])->name('banner_edit');

        Route::delete('/banner_delete/{id}', [BannerController::class, 'bannerDelete'])->name('banner_delete');

        Route::get('/banner_add', [BannerController::class, 'bannerAdd'])->name('banner_add');
    }
);
