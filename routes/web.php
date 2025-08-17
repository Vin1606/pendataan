<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

// LINK GET ASURANSI
Route::get('/', [DataController::class, 'index'])->name('index');
Route::get('/CreateAsuransi', [DataController::class, 'create_asuransi'])->name('create_asuransi');
Route::get('/exportInsurance', [DataController::class, 'export'])->name('exportInsurance');
Route::get('/DetailAsuransi/{insurance}', [DataController::class, 'detail_asuransi'])->name('detail_asuransi');
Route::get('/export-pdf-insurance', [DataController::class, 'exportPDF'])->name('export.pdf');
Route::get('/cek-url', function () {
    return dd(config('app.url'));
});



// LINK GET STNK
Route::get('/exportStnk', [DataController::class, 'exportSTNK'])->name('exportStnk');
Route::get('/DataStnk', [DataController::class, 'data_stnk'])->name('data.stnk');
Route::get('/CreateStnk', [DataController::class, 'create_stnk'])->name('create_stnk');
Route::get('/EditStnk/{stnk}', [DataController::class, 'edit_stnk'])->name('edit_stnk');
Route::get('/DetailStnk/{stnk}', [DataController::class, 'detail_stnk'])->name('detail_stnk');
Route::get('/export-pdf-stnk', [DataController::class, 'exportPDFSTNK'])->name('exportPDFSTNK');

// POST
Route::post('/store', [DataController::class, 'store'])->name('store');
Route::post('/StoreStnk', [DataController::class, 'store_stnk'])->name('store_stnk');
Route::post('/upload/{stnk}', [DataController::class, 'uploadPhoto'])->name('stnk.upload');

// PUT
Route::put('/DetailAsuransi/{insurance}', [DataController::class, 'update_asuransi'])->name('update_asuransi');
Route::put('/DetailStnk/{stnk}', [DataController::class, 'update_stnk'])->name('update_stnk');

Route::delete('/photo/{stnk}', [DataController::class, 'deletePhoto'])->name('photo.delete');
