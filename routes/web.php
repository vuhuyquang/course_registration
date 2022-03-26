<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiemSoController;
use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\HocKyController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\NganhHocController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\QuanTriVienController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\SVDKController;
use App\Http\Controllers\TinTucController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('layouts.site');
});

Route::prefix('quan-tri-vien')->group(function () {
    Route::get('/', [AuthController::class, 'home'])->name('quan-tri-vien.home');

    Route::prefix('khoa')->group(function () {
        Route::get('/', [KhoaController::class, 'index'])->name('khoa.index');
        Route::get('/them', [KhoaController::class, 'create'])->name('khoa.create');
        Route::post('/them', [KhoaController::class, 'store'])->name('khoa.store');
        Route::get('/sua/{id}', [KhoaController::class, 'edit'])->name('khoa.edit');
        Route::post('/sua/{id}', [KhoaController::class, 'update'])->name('khoa.update');
        Route::get('/xoa/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy');
        Route::get('/danh-sach-lop/{id}', [KhoaController::class, 'classlist'])->name('khoa.classlist');
    });

    Route::prefix('nganh-hoc')->group(function () {
        Route::get('/', [NganhHocController::class, 'index'])->name('nganh-hoc.index');
        Route::get('/them', [NganhHocController::class, 'create'])->name('nganh-hoc.create');
        Route::post('/them', [NganhHocController::class, 'store'])->name('nganh-hoc.store');
        Route::get('/sua/{id}', [NganhHocController::class, 'edit'])->name('nganh-hoc.edit');
        Route::post('/sua/{id}', [NganhHocController::class, 'update'])->name('nganh-hoc.update');
        Route::get('/xoa/{id}', [NganhHocController::class, 'destroy'])->name('nganh-hoc.destroy');
        Route::get('/danh-sach-mon-hoc/{id}', [NganhHocController::class, 'classlist'])->name('nganh-hoc.classsubjects');
    });

        Route::prefix('giang-vien')->group(function () {
        Route::get('/', [GiangVienController::class, 'index'])->name('giang-vien.index');
        Route::get('/them', [GiangVienController::class, 'create'])->name('giang-vien.create');
        Route::post('/them', [GiangVienController::class, 'store'])->name('giang-vien.store');
        Route::get('/sua/{id}', [GiangVienController::class, 'edit'])->name('giang-vien.edit');
        Route::post('/sua/{id}', [GiangVienController::class, 'update'])->name('giang-vien.update');
        Route::get('/xoa/{id}', [GiangVienController::class, 'destroy'])->name('giang-vien.destroy');
    });

    Route::prefix('hoc-ky')->group(function () {
        Route::get('/', [HocKyController::class, 'index'])->name('hoc-ky.index');
        Route::get('/them', [HocKyController::class, 'create'])->name('hoc-ky.create');
        Route::post('/them', [HocKyController::class, 'store'])->name('hoc-ky.store');
        Route::get('/sua/{id}', [HocKyController::class, 'edit'])->name('hoc-ky.edit');
        Route::post('/sua/{id}', [HocKyController::class, 'update'])->name('hoc-ky.update');
        Route::get('/xoa/{id}', [HocKyController::class, 'destroy'])->name('hoc-ky.destroy');
        Route::get('/xet-trang-thai', [HocKyController::class, 'setstatus'])->name('hoc-ky.setstatus');
        Route::post('/xet-trang-thai', [HocKyController::class, 'storesetstatus'])->name('hoc-ky.storesetstatus');
    });

    Route::prefix('khoa-hoc')->group(function () {
        Route::get('/', [KhoaHocController::class, 'index'])->name('khoa-hoc.index');
        Route::get('/them', [KhoaHocController::class, 'create'])->name('khoa-hoc.create');
        Route::post('/them', [KhoaHocController::class, 'store'])->name('khoa-hoc.store');
        Route::get('/sua/{id}', [KhoaHocController::class, 'edit'])->name('khoa-hoc.edit');
        Route::post('/sua/{id}', [KhoaHocController::class, 'update'])->name('khoa-hoc.update');
        Route::get('/xoa/{id}', [KhoaHocController::class, 'destroy'])->name('khoa-hoc.destroy');
        Route::get('/danh-sach-lop/{id}', [KhoaHocController::class, 'classlist'])->name('khoa-hoc.classlist');
    });

    Route::prefix('lop-hoc')->group(function () {
        Route::get('/', [LopHocController::class, 'index'])->name('lop-hoc.index');
        Route::get('/them', [LopHocController::class, 'create'])->name('lop-hoc.create');
        Route::post('/them', [LopHocController::class, 'store'])->name('lop-hoc.store');
        Route::get('/sua/{id}', [LopHocController::class, 'edit'])->name('lop-hoc.edit');
        Route::post('/sua/{id}', [LopHocController::class, 'update'])->name('lop-hoc.update');
        Route::get('/xoa/{id}', [LopHocController::class, 'destroy'])->name('lop-hoc.destroy');
    });

    Route::prefix('mon-hoc')->group(function () {
        Route::get('/', [MonHocController::class, 'index'])->name('mon-hoc.index');
        Route::get('/them', [MonHocController::class, 'create'])->name('mon-hoc.create');
        Route::post('/them', [MonHocController::class, 'store'])->name('mon-hoc.store');
        Route::get('/sua/{id}', [MonHocController::class, 'edit'])->name('mon-hoc.edit');
        Route::post('/sua/{id}', [MonHocController::class, 'update'])->name('mon-hoc.update');
        Route::get('/xoa/{id}', [MonHocController::class, 'destroy'])->name('mon-hoc.destroy');
    });

    Route::prefix('sinh-vien')->group(function () {
        Route::get('/', [SinhVienController::class, 'index'])->name('sinh-vien.index');
        Route::get('/them', [SinhVienController::class, 'create'])->name('sinh-vien.create');
        Route::post('/them', [SinhVienController::class, 'store'])->name('sinh-vien.store');
        Route::get('/sua', [SinhVienController::class, 'edit'])->name('sinh-vien.edit');
        Route::post('/sua', [SinhVienController::class, 'update'])->name('sinh-vien.update');
        Route::get('/xoa', [SinhVienController::class, 'destroy'])->name('sinh-vien.destroy');
    });
});

Route::prefix('giang-vien')->group(function () {
    
});

Route::prefix('sinh-vien')->group(function () {
    Route::get('/', [AuthController::class, 'home3'])->name('sinh-vien.home');

    Route::get('/', function ($id) {
        
    });
});
