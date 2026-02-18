<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/pelatihan/{slug}', [HomeController::class, 'showDepartment'])->name('workshop.detail');
Route::get('/fasilitas', [HomeController::class, 'facilities'])->name('facilities');
Route::get('/tata-cara-daftar', [HomeController::class, 'registrationGuide'])->name('registration.guide');

Route::prefix('pelayanan')->name('service.')->group(function () {
    Route::get('/maklumat', [HomeController::class, 'maklumat'])->name('maklumat');
    Route::get('/standar', [HomeController::class, 'standar'])->name('standar');
    Route::get('/survei-kepuasan', [HomeController::class, 'surveySatisfaction'])->name('survey');
    Route::get('/pengaduan', [HomeController::class, 'complaint'])->name('complaint');
    Route::get('/survei-alumni', [HomeController::class, 'surveyAlumni'])->name('alumni');
});

Route::get('/faq', [HomeController::class, 'faq'])->name('public.faq');
Route::get('/berita', [HomeController::class, 'news'])->name('public.news');
Route::get('/informasi-pelatihan', [HomeController::class, 'trainingInfo'])->name('public.training');
Route::get('/{post:slug}', [HomeController::class, 'postDetail'])->name('public.post.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('department')->name('department.')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
        Route::post('/create', [DepartmentController::class, 'store'])->name('store');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('workshop')->name('workshop.')->group(function () {
        Route::get('/', [WorkshopController::class, 'index'])->name('index');
        Route::get('/{workshop}', [WorkshopController::class, 'show'])->name('show');
        Route::post('/create', [WorkshopController::class, 'store'])->name('store');
        Route::get('/{workshop}/edit', [WorkshopController::class, 'edit'])->name('edit');
        Route::put('/{workshop}', [WorkshopController::class, 'update'])->name('update');
        Route::delete('/{workshop}', [WorkshopController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/{key}', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/{key}', [ProfileController::class, 'update'])->name('update');
    });

    Route::prefix('facility')->name('facility.')->group(function () {
        Route::get('/', [FacilityController::class, 'index'])->name('index');
        Route::post('/create', [FacilityController::class, 'store'])->name('store');
        Route::get('/{facility}', [FacilityController::class, 'show'])->name('show');
        Route::put('/{facility}', [FacilityController::class, 'update'])->name('update');
        Route::delete('/{facility}', [FacilityController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('information')->name('information.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/{post}', [PostController::class, 'detail'])->name('detail');
        Route::get('/show/{post}', [PostController::class, 'show'])->name('show');
        Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/delete/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::get('/show/{faq}', [FaqController::class, 'show'])->name('show');
        Route::put('/update/{faq}', [FaqController::class, 'update'])->name('update');
        Route::delete('/delete/{faq}', [FaqController::class, 'destroy'])->name('delete');
    });
});

