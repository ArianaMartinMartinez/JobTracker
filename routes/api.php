<?php

use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ProgressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/offers', [OfferController::class, 'index'])->name('apiHomeOffers');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('apiShowOffer');
Route::post('/offers', [OfferController::class, 'store'])->name('apiStoreOffer');
Route::put('/offers/{id}', [OfferController::class, 'update'])->name('apiUpdateOffer');
Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->name('apiDestroyOffer');

Route::get('/progresses', [ProgressController::class, 'index'])->name('apiHomeProgresses');
Route::get('/progresses/{id}', [ProgressController::class, 'show'])->name('apiShowProgress');
Route::post('/progresses', [ProgressController::class, 'store'])->name('apiStoreProgress');
Route::put('/progresses/{id}', [ProgressController::class, 'update'])->name('apiUpdateProgress');
Route::delete('/progresses/{id}', [ProgressController::class, 'destroy'])->name('apiDestroyProgress');