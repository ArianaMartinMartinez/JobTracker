<?php

use App\Http\Controllers\Api\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/offers', [OfferController::class, 'index'])->name('apiHomeOffers');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('apiShowOffer');
Route::post('/offers', [OfferController::class, 'store'])->name('apiStoreOffer');
Route::put('/offers/{id}', [OfferController::class, 'update'])->name('apiUpdateOffer');
Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->name('apiDestroyOffer');