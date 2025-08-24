<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Middleware\EnsureUserDataIsComplete;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

// Route for All Data Kendaraan
Route::get('/All', [DataController::class, 'all'])->name('all.kendaraan')->middleware(['auth', EnsureUserDataIsComplete::class]);
Route::get('/CreateKendaraan', [DataController::class, 'createkendaraan'])->name('create_kendaraan');
Route::get('/EditAll/{kendaraan}', [DataController::class, 'editall'])->name('edit_all');

// LINK GET ASURANSI
Route::get('/Asuransi', [DataController::class, 'index'])->name('index')->middleware(['auth', EnsureUserDataIsComplete::class]);
Route::get('/CreateAsuransi', [DataController::class, 'create_asuransi'])->name('create_asuransi');
Route::get('/exportInsurance', [DataController::class, 'export'])->name('exportInsurance');
Route::get('/DetailAsuransi/{kendaraan}', [DataController::class, 'detail_asuransi'])->name('detail_asuransi');
Route::get('/export-pdf-insurance', [DataController::class, 'exportPDF'])->name('export.pdf');

// LINK GET STNK
Route::get('/exportStnk', [DataController::class, 'exportSTNK'])->name('exportStnk');
Route::get('/DataStnk', [DataController::class, 'data_stnk'])->name('data.stnk')->middleware(['auth', EnsureUserDataIsComplete::class]);
Route::get('/CreateStnk', [DataController::class, 'create_stnk'])->name('create_stnk');
Route::get('/EditStnk/{kendaraan}', [DataController::class, 'edit_stnk'])->name('edit_stnk');
Route::get('/DetailStnk/{stnk}', [DataController::class, 'detail_stnk'])->name('detail_stnk');
Route::get('/export-pdf-stnk', [DataController::class, 'exportPDFSTNK'])->name('exportPDFSTNK');
Route::get('/surat-kuasa-stnk/{kendaraan}', [DataController::class, 'KuasaSTNKPDF'])->name('KuasaSTNKPDF');

// LINK GET KIR
Route::get('/DataKir', [DataController::class, 'data_kir'])->name('data.kir')->middleware(['auth', EnsureUserDataIsComplete::class]);
Route::get('/EditKir/{kendaraan}', [DataController::class, 'edit_kir'])->name('EditKir');
Route::get('/surat-kuasa-kir', [DataController::class, 'KuasaKIRPDF'])->name('KuasaKIRPDF');

// LINK GET KARYAWAN
Route::get('/DataKaryawan', [DataController::class, 'data_karyawan'])->name('data.karyawan')->middleware(['auth', EnsureUserDataIsComplete::class]);
Route::get('/CreateKaryawan', [DataController::class, 'create_karyawan'])->name('create_karyawan');

// POST
Route::post('/store', [DataController::class, 'store'])->name('store');
Route::post('/StoreStnk', [DataController::class, 'store_stnk'])->name('store_stnk');
Route::post('/StoreKendaraan', [DataController::class, 'store_kendaraan'])->name('store_kendaraan');
Route::post('/StoreKaryawan', [DataController::class, 'store_karyawan'])->name('store_karyawan');
Route::post('/upload/{stnk}', [DataController::class, 'uploadPhoto'])->name('stnk.upload');

// PUT
Route::put('/DetailAsuransi/{kendaraan}', [DataController::class, 'update_asuransi'])->name('update_asuransi');
Route::put('/EditAll/{kendaraan}', [DataController::class, 'update_all'])->name('update_all');
Route::put('/DetailStnk/{kendaraan}', [DataController::class, 'update_stnk'])->name('update_stnk');
Route::put('/UpdateKir/{kendaraan}', [DataController::class, 'update_kir'])->name('update_kir');

// DELETE
Route::delete('/photo/{stnk}', [DataController::class, 'deletePhoto'])->name('photo.delete');

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/robots.txt', function () {
    return response('User-agent: *\nDisallow:', 200)
        ->header('Content-Type', 'text/plain');
});
