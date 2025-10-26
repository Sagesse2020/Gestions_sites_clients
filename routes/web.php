<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientSiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client', [ClientSiteController::class, 'index'])->name('Client');
Route::get('/Createclient', [ClientSiteController::class, 'create'])->name('Create');
Route::post('/Createclient', [ClientSiteController::class, 'store'])->name('Store');
