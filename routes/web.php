<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\DiemSoController;
use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\HocKyController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\NganhHocController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\HocPhanController;
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
Route::get('', [TaiKhoanController::class, 'getLogin'])->name('getLogin');
Route::get('login', [TaiKhoanController::class, 'getLogin'])->name('getLogin');
Route::post('login', [TaiKhoanController::class, 'postLogin'])->name('postLogin');
Route::get('logout', [TaiKhoanController::class, 'getLogout'])->name('getLogout');
Route::get('redirect', [TaiKhoanController::class, 'redirect'])->name('redirect');
Route::get('profile', [TaiKhoanController::class, 'profile'])->name('profile');
Route::post('profile', [TaiKhoanController::class, 'postProfile'])->name('postProfile');
Route::get('change-password', [TaiKhoanController::class, 'getChangePassword'])->name('getChangePassword');
Route::post('change-password', [TaiKhoanController::class, 'postChangePassword'])->name('postChangePassword');

Route::prefix('admin')->middleware('checkAdmin')->group(function () {
    Route::prefix('department')->group(function () {
        Route::get('/', [KhoaController::class, 'index'])->name('khoa.index');
        Route::get('/create', [KhoaController::class, 'create'])->name('khoa.create');
        Route::post('/store', [KhoaController::class, 'store'])->name('khoa.store');
        Route::get('/edit/{id}', [KhoaController::class, 'edit'])->name('khoa.edit');
        Route::post('/update/{id}', [KhoaController::class, 'update'])->name('khoa.update');
        Route::get('/destroy/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy');
    });

    Route::prefix('majors')->group(function () {
        Route::get('/', [NganhHocController::class, 'index'])->name('nganh-hoc.index');
        Route::get('/create', [NganhHocController::class, 'create'])->name('nganh-hoc.create');
        Route::post('/store', [NganhHocController::class, 'store'])->name('nganh-hoc.store');
        Route::get('/edit/{id}', [NganhHocController::class, 'edit'])->name('nganh-hoc.edit');
        Route::post('/update/{id}', [NganhHocController::class, 'update'])->name('nganh-hoc.update');
        Route::get('/destroy/{id}', [NganhHocController::class, 'destroy'])->name('nganh-hoc.destroy');
        Route::get('/subjects-list/{id}', [NganhHocController::class, 'classlist'])->name('nganh-hoc.classsubjects');
    });

        Route::prefix('teacher')->group(function () {
        Route::get('/', [GiangVienController::class, 'index'])->name('giang-vien.index');
        Route::get('/create', [GiangVienController::class, 'create'])->name('giang-vien.create');
        Route::post('/store', [GiangVienController::class, 'store'])->name('giang-vien.store');
        Route::get('/edit/{id}', [GiangVienController::class, 'edit'])->name('giang-vien.edit');
        Route::post('/update/{id}', [GiangVienController::class, 'update'])->name('giang-vien.update');
        Route::get('/destroy/{id}', [GiangVienController::class, 'destroy'])->name('giang-vien.destroy');
        Route::get('/reset-password/{id}', [GiangVienController::class, 'resetPassword'])->name('giang-vien.resetPassword');
        Route::get('/profile/{id}', [GiangVienController::class, 'profile'])->name('giang-vien.profile');
        Route::get('/export', [GiangVienController::class, 'export'])->name('giang-vien.export');
    });

    Route::prefix('term')->group(function () {
        Route::get('/', [HocKyController::class, 'index'])->name('hoc-ky.index');
        Route::get('/create', [HocKyController::class, 'create'])->name('hoc-ky.create');
        Route::post('/store', [HocKyController::class, 'store'])->name('hoc-ky.store');
        Route::get('/edit/{id}', [HocKyController::class, 'edit'])->name('hoc-ky.edit');
        Route::post('/update/{id}', [HocKyController::class, 'update'])->name('hoc-ky.update');
        Route::get('/destroy/{id}', [HocKyController::class, 'destroy'])->name('hoc-ky.destroy');
        Route::get('/set-status/{id}', [HocKyController::class, 'setStatus'])->name('hoc-ky.setStatus');
    });

    Route::prefix('school-year')->group(function () {
        Route::get('/', [KhoaHocController::class, 'index'])->name('khoa-hoc.index');
        Route::get('/create', [KhoaHocController::class, 'create'])->name('khoa-hoc.create');
        Route::post('/store', [KhoaHocController::class, 'store'])->name('khoa-hoc.store');
        Route::get('/edit/{id}', [KhoaHocController::class, 'edit'])->name('khoa-hoc.edit');
        Route::post('/update/{id}', [KhoaHocController::class, 'update'])->name('khoa-hoc.update');
        Route::get('/destroy/{id}', [KhoaHocController::class, 'destroy'])->name('khoa-hoc.destroy');
        Route::get('/class-list/{id}', [KhoaHocController::class, 'classlist'])->name('khoa-hoc.classlist');
    });

    Route::prefix('class')->group(function () {
        Route::get('/', [LopHocController::class, 'index'])->name('lop-hoc.index');
        Route::get('/create', [LopHocController::class, 'create'])->name('lop-hoc.create');
        Route::post('/store', [LopHocController::class, 'store'])->name('lop-hoc.store');
        Route::get('/edit/{id}', [LopHocController::class, 'edit'])->name('lop-hoc.edit');
        Route::post('/update/{id}', [LopHocController::class, 'update'])->name('lop-hoc.update');
        Route::get('/destroy/{id}', [LopHocController::class, 'destroy'])->name('lop-hoc.destroy');
    });

    Route::prefix('subjects')->group(function () {
        Route::get('/', [MonHocController::class, 'index'])->name('mon-hoc.index');
        Route::get('/create', [MonHocController::class, 'create'])->name('mon-hoc.create');
        Route::post('/store', [MonHocController::class, 'store'])->name('mon-hoc.store');
        Route::get('/edit/{id}', [MonHocController::class, 'edit'])->name('mon-hoc.edit');
        Route::post('/update/{id}', [MonHocController::class, 'update'])->name('mon-hoc.update');
        Route::get('/destroy/{id}', [MonHocController::class, 'destroy'])->name('mon-hoc.destroy');
        Route::get('/block/{id}', [MonHocController::class, 'block'])->name('mon-hoc.block');
    });

    Route::prefix('student')->group(function () {
        Route::get('/', [SinhVienController::class, 'index'])->name('sinh-vien.index');
        Route::get('/create', [SinhVienController::class, 'create'])->name('sinh-vien.create');
        Route::post('/store', [SinhVienController::class, 'store'])->name('sinh-vien.store');
        Route::get('/edit/{id}', [SinhVienController::class, 'edit'])->name('sinh-vien.edit');
        Route::post('/update/{id}', [SinhVienController::class, 'update'])->name('sinh-vien.update');
        Route::get('/destroy/{id}', [SinhVienController::class, 'destroy'])->name('sinh-vien.destroy');
        Route::get('/reset-password/{id}', [SinhVienController::class, 'resetPassword'])->name('sinh-vien.resetPassword');
        Route::get('/profile/{id}', [SinhVienController::class, 'profile'])->name('sinh-vien.profile');
        Route::get('/export', [SinhVienController::class, 'export'])->name('sinh-vien.export');
        Route::post('/import', [SinhVienController::class, 'import'])->name('sinh-vien.import');
    });

    Route::prefix('module')->group(function () {
        Route::get('/', [HocPhanController::class, 'index'])->name('hoc-phan.index');
        Route::get('/create', [HocPhanController::class, 'create'])->name('hoc-phan.create');
        Route::post('/store', [HocPhanController::class, 'store'])->name('hoc-phan.store');
        Route::get('/edit/{id}', [HocPhanController::class, 'edit'])->name('hoc-phan.edit');
        Route::post('/update/{id}', [HocPhanController::class, 'update'])->name('hoc-phan.update');
        Route::get('/destroy/{id}', [HocPhanController::class, 'destroy'])->name('hoc-phan.destroy');
        Route::get('/class-list/{id}', [HocPhanController::class, 'show'])->name('hoc-phan.show');
        Route::get('/export/{id}', [HocPhanController::class, 'export'])->name('svdk.export');
    });
});

Route::prefix('teacher')->middleware('checkTeacher')->group(function () {
    Route::get('/class-subjects', [GiangVienController::class, 'classSubject'])->name('giangvien.classSubjects');
    Route::get('/mark/{id}', [GiangVienController::class, 'mark'])->name('giangvien.mark');
    Route::post('/mark', [GiangVienController::class, 'markStore'])->name('giangvien.markStore');
});

Route::prefix('student')->middleware('checkStudent')->group(function () {
    Route::get('/subjects-lookup', [SinhVienController::class, 'lookup'])->name('sinhvien.lookup');
    Route::get('/subjects-lookup/{id}', [SinhVienController::class, 'lookupid'])->name('sinhvien.lookup.id');
    Route::get('/course-registration', [SinhVienController::class, 'register'])->name('sinhvien.register');
    Route::post('/course-registration', [SinhVienController::class, 'registerStore'])->name('sinhvien.register.store');
    Route::get('/cancel-registration/{id}', [SinhVienController::class, 'cancelRegister'])->name('sinhvien.cancelRegister');
    Route::get('/scores', [SinhVienController::class, 'scores'])->name('sinhvien.scores');
});
