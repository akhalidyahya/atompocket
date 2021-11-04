<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;

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
    return redirect()->route('masterData.wallet.index');
});

Route::group(['prefix' => 'master-data'], function () {
    //wallet
    Route::get('/dompet',[WalletController::class,'index'])->name('masterData.wallet.index');
    Route::get('/dompet/add',[WalletController::class,'add'])->name('masterData.wallet.add');
    Route::get('/dompet/{id}/{mode}',[WalletController::class,'detail'])->name('masterData.wallet.detail');
    Route::post('/dompet',[WalletController::class,'save'])->name('masterData.wallet.save');
    Route::post('/dompet/change-status/{id}',[WalletController::class,'changeStatus'])->name('masterData.wallet.changeStatus');
    Route::get('/dompet/getDataTable',[WalletController::class,'getDataTable'])->name('masterData.wallet.getDataTable');

    //category
    Route::get('/kategori',[CategoryController::class,'index'])->name('masterData.category.index');
    Route::get('/kategori/add',[CategoryController::class,'add'])->name('masterData.category.add');
    Route::get('/kategori/{id}/{mode}',[CategoryController::class,'detail'])->name('masterData.category.detail');
    Route::post('/kategori',[CategoryController::class,'save'])->name('masterData.category.save');
    Route::post('/kategori/change-status/{id}',[CategoryController::class,'changeStatus'])->name('masterData.category.changeStatus');
    Route::get('/kategori/getDataTable',[CategoryController::class,'getDataTable'])->name('masterData.category.getDataTable');
});

//transaksi
Route::get('/transaksi/{id}',[TransactionController::class,'index'])->where(['id'=>'[0-9]+'])->name('transaction.index');
Route::get('/transaksi/add/{id}',[TransactionController::class,'add'])->where(['id'=>'[0-9]+'])->name('transaction.add');
Route::post('/transaksi/{id}',[TransactionController::class,'save'])->where(['id'=>'[0-9]+'])->name('transaction.save');
Route::get('/transaksi/getDataTable',[TransactionController::class,'getDataTable'])->name('transaction.getDataTable');

//laporan
Route::get('/laporan',[ReportController::class,'index'])->name('report.index');
Route::post('/laporan/hasil',[ReportController::class,'result'])->name('report.result');

?>