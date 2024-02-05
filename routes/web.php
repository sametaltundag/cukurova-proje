<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeklifController;
use Illuminate\Support\Facades\Route;


/* CustomAuthhController Side */
Route::post('/giris', [CustomAuthController::class,'giris'])->name('giris');



/* HomeController Side */
Route::get('/',[HomeController::class,'dashboard'])->name('dashboard');
Route::get('/panel',[HomeController::class,'index'])->name('panel.index');
Route::get('sliders', [HomeController::class, 'slider'])->name('slider.index');
Route::put('slider/update/{id}', [HomeController::class, 'sliderupdate'])->name('slider.update');
Route::get('slider/{id}',[HomeController::class,'slidershow'])->name('slidershow');
Route::post('slider/create',[HomeController::class,'slidercreate'])->name('slidercreate');


/* FirmaController Side */
Route::get('/firmaara',[FirmaController::class,'firmaara']);
Route::get('/firma-detay/{id}',[FirmaController::class,'firmadetay']);
Route::post('firmakaydet',[FirmaController::class,'firmakaydet'])->name('firmakaydet');



/* TeklfiController Side */
Route::post('teklifkaydet/{id}',[TeklifController::class,'teklifkaydet'])->name('teklifkaydet');
