<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ClientSiteController;
use App\Http\Controllers\HebergementClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client', [ClientSiteController::class, 'index'])->name('Client');
Route::get('/Createclient', [ClientSiteController::class, 'create'])->name('Create');
Route::post('/Createclient', [ClientSiteController::class, 'store'])->name('Store');
Route::get('/github', [GitHubController::class, 'index'])->name('github.index');
// Page d'accueil du tableau de bord hébergements
Route::get('/hebergements', [HebergementClientController::class, 'index'])->name('hebergements.index');

// Formulaire pour créer un nouvel hébergement
Route::get('/hebergements/create', [HebergementClientController::class, 'create'])->name('hebergements.create');

// Stocker un nouvel hébergement
Route::post('/hebergements/store', [HebergementClientController::class, 'store'])->name('hebergements.store');

// Bouton pour suspendre / réactiver un hébergement
Route::post('/hebergements/toggle/{id}', [HebergementClientController::class, 'toggleStatut'])->name('hebergements.toggle');
route::get('/expirationHebergement', function() {
    return view('emaails.expiration_alerte');
});

