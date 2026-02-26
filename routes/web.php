<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ClientSiteController;
use App\Http\Controllers\HebergementClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/github', [GitHubController::class, 'index'])->name('github.index');
Route::resource('clients', ClientSiteController::class);
Route::resource('hebergements', HebergementClientController::class);
Route::post('hebergements/{id}/toggle', [HebergementClientController::class, 'toggleStatut'])
    ->name('hebergements.toggle');

// Email d'expiration de l'hebergement
route::get('/expirationHebergement', function() {
    return view('emails.expiration_alerte');
});

