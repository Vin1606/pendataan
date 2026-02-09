<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\StnkController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\EnsureUserDataIsComplete;

// ALL ROUTES

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register.post');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// ROUTES DASHBOARD
Route::controller(DashboardController::class)->group(function () {
    Route::get('/Dashboard', 'dashboard')->name('dashboard');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// ROUTES DATA LENGKAP KENDARAAN
Route::controller(DataController::class)->group(function () {
    Route::get('/All', 'all')->name('all.kendaraan')->middleware(['auth', EnsureUserDataIsComplete::class]);

    // CREATE DATA
    Route::get('/CreateKendaraan', 'createkendaraan')->name('create_kendaraan');
    Route::post('/StoreKendaraan', 'store_kendaraan')->name('store_kendaraan');

    // UPDATE DATA
    Route::get('/EditAll/{kendaraan}', 'editall')->name('edit_all');
    Route::put('/UpdateAll/{kendaraan}', 'update_all')->name('update_all');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// ROUTES ASURANSI
Route::controller(AsuransiController::class)->group(function () {
    Route::get('/Asuransi', 'index')->name('index')->middleware(['auth', EnsureUserDataIsComplete::class]);

    // CREATE DATA
    Route::get('/CreateAsuransi', 'create_asuransi')->name('create_asuransi');
    Route::post('/store', 'store')->name('store');

    // UPDATE DATA
    Route::get('/DetailAsuransi/{kendaraan}', 'detail_asuransi')->name('detail_asuransi');
    Route::put('/UpdateAsuransi/{kendaraan}', 'update_asuransi')->name('update_asuransi');;

    // EXPORT DATA
    Route::get('/exportInsurance', 'export')->name('exportInsurance');
    Route::get('/export-pdf-insurance', 'exportPDF')->name('export.pdf');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// ROUTES STNK
Route::controller(StnkController::class)->group(function () {
    Route::get('/DataStnk', 'data_stnk')->name('data.stnk')->middleware(['auth', EnsureUserDataIsComplete::class]);

    // CREATE DATA
    Route::get('/CreateStnk', 'create_stnk')->name('create_stnk');
    Route::post('/StoreStnk', 'store_stnk')->name('store_stnk');

    // UPDATE DATA
    Route::get('/EditStnk/{kendaraan}', 'edit_stnk')->name('edit_stnk');
    Route::put('/DetailStnk/{kendaraan}', [StnkController::class, 'update_stnk'])->name('update_stnk');

    // EXPORT DATA
    Route::get('/exportStnk', 'exportSTNK')->name('exportStnk');
    Route::get('/export-pdf-stnk', 'exportPDFSTNK')->name('exportPDFSTNK');
    Route::get('/surat-kuasa-stnk/{kendaraan}', 'KuasaSTNKPDF')->name('KuasaSTNKPDF');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// ROUTES KIR
Route::controller(KirController::class)->group(function () {
    Route::get('/DataKir', 'data_kir')->name('data.kir')->middleware(['auth', EnsureUserDataIsComplete::class]);

    // UPDATE DATA
    Route::get('/EditKir/{kendaraan}', 'edit_kir')->name('EditKir');
    Route::put('/UpdateKir/{kendaraan}', 'update_kir')->name('update_kir');

    // EXPORT DATA
    Route::get('/surat-kuasa-kir/{kendaraan}', 'KuasaKIRPDF')->name('KuasaKIRPDF');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// ROUTES KARYAWAN
Route::controller(KaryawanController::class)->group(function () {
    Route::get('/DataKaryawan', [KaryawanController::class, 'data_karyawan'])->name('data.karyawan')->middleware(['auth', EnsureUserDataIsComplete::class]);

    // CREATE DATA
    Route::get('/CreateKaryawan', 'create_karyawan')->name('create_karyawan');
    Route::post('/StoreKaryawan', 'store_karyawan')->name('store_karyawan');

    // UPDATE DATA
    Route::get('/EditKaryawan/{karyawan}', 'edit_karyawan')->name('edit_karyawan');
    Route::put('/UpdateKaryawan/{karyawan}', 'update_karyawan')->name('update_karyawan');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /',
    ];
    return response(implode("\n", $lines), 200)
        ->header('Content-Type', 'text/plain');
});
