<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;

Route::get('/', [OfferController::class, 'index'])->name('home');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('showDetail');
Route::get('/new-offer', [OfferController::class, 'create'])->name('createOffer');
Route::post('/new-offer', [OfferController::class, 'store'])->name('storeOffer');