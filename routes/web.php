<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', [UrlController::class, 'index'])->name('index');

Route::post('/url', [UrlController::class, 'store'])->name('store');
Route::get('/{hash}', [UrlController::class, 'redirect'])->name('redirect')->where('hash', '.*');

