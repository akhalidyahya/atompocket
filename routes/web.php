<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;

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
    return view('welcome');
});

Route::group(['prefix' => 'master-data'], function () {
    Route::get('/dompet',[WalletController::class,'index'])->name('masterData.wallet.index');
    Route::get('/dompet/add',[WalletController::class,'add'])->name('masterData.wallet.add');
    Route::get('/dompet/{id}/{mode}',[WalletController::class,'detail'])->name('masterData.wallet.detail');
    Route::post('/dompet',[WalletController::class,'save'])->name('masterData.wallet.save');
    Route::post('/dompet/change-status/{id}',[WalletController::class,'changeStatus'])->name('masterData.wallet.changeStatus');
    Route::get('/dompet/getDataTable',[WalletController::class,'getDataTable'])->name('masterData.wallet.getDataTable');
});

?>