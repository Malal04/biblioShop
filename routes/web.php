<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('m', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('app/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');
Route::get('/', [PublicController::class, 'index'])->name('public_page');
Route::get('/livres/{livre}', [PublicController::class, 'show'])->name('public_page.livre.show');
Route::get('/services', [PublicController::class, 'services'])->name('public_page.services');
Route::get('public/page/categorie/{id}', [PublicController::class, 'showCategory'])->name('public_page.categorie.show');
Route::post('/commande', [CommandeController::class, 'passerCommande'])->name('commande.passer')->middleware('auth');
Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commandes.index')->middleware('auth');
Route::post('/commande/valider', [CommandeController::class, 'validerCommander'])->name('commande.valider');
Route::get('/livres', [PublicController::class, 'livre_index'])->name('public_page.livre');
Route::get('/recherche', [PublicController::class, 'search'])->name('public_page.livre.recherche');


Route::put('/commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commande.updateStatut');
Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commande.show');
Route::get('dashboard/commandes', [CommandeController::class, 'indexCommande'])->name('commandes.indexCommande');
Route::get('/commandes/{id}', [CommandeController::class, 'sCommande'])->name('commandes.showCommandes');
Route::get('/commandes/{id}/email', [CommandeController::class, 'sendEmail'])->name('commandes.email');
Route::get('/commandes/{id}/pdf', [CommandeController::class, 'exportPDF'])->name('commandes.pdf');


Route::prefix('dashboard/categorie')->name('dashboard.categorie.')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('cIndex');
    Route::get('/create', [CategoryController::class, 'create'])->name('cCreate'); 
    Route::post('/store', [CategoryController::class, 'store'])->name('cStore'); 
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('cEdit'); 
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('cUpdate'); 
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('cDelete'); 
});
Route::prefix('dashboard/livre')->name('dashboard.livre.')->group(function() {
    Route::get('/', [LivreController::class, 'index'])->name('lIndex');
    Route::get('/create', [LivreController::class, 'create'])->name('lCreate'); 
    Route::post('/store', [LivreController::class, 'store'])->name('lStore'); 
    Route::get('/edit/{id}', [LivreController::class, 'edit'])->name('lEdit'); 
    Route::put('/update/{id}', [LivreController::class, 'update'])->name('lUpdate'); 
    Route::delete('/delete/{id}', [LivreController::class, 'destroy'])->name('lDelete'); 
    Route::get('/search', [LivreController::class, 'search'])->name('lSearch');
});
Route::prefix('dashboard/user')->name('dashboard.user.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('uIndex');
    Route::get('/create', [UserController::class, 'create'])->name('uCreate'); 
    Route::post('/store', [UserController::class, 'store'])->name('uStore'); 
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('uEdit'); 
    Route::put('/update/{id}', [UserController::class, 'update'])->name('uUpdate'); 
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('uDelete'); 
});

Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::post('/cart/remove', [CartController::class, 'removeFromCart']);
Route::get('/cart', [CartController::class, 'getCart']);
Route::post('/cart/order', [CartController::class, 'placeOrder']);
Route::post('/panier', [CartController::class, 'savePanier']);
