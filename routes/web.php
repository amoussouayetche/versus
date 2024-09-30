<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.connexion');
});

// inscription
Route::get('/page-inscription', [AuthController::class, 'pageInscription'])->name('page-inscription');
Route::post('/inscription', [AuthController::class, 'inscription'])->name('inscription');

// connexion
Route::get('/page-connexion', [AuthController::class, 'pageConnexion'])->name('page-connexion');
Route::post('/connexion', [AuthController::class, 'connexion'])->name('connexion');

// condition utilisation
Route::get('/condition-utilisation/{client}', [AuthController::class, 'pageCondition'])->name('page-condition');
Route::post('/accepter-condition-utilisation/{client}', [AuthController::class, 'condition'])->name('condition');

// OTP
Route::get('/page-otp', [AuthController::class, 'pageOtp'])->name('page-otp');
Route::post('/vérifier-otp', [AuthController::class, 'verifierOtp'])->name('verifier-otp');

Route::middleware('auth.admin')->group(function () {
     //chat
    Route::get('/liste-client', [ChatController::class, 'showAdmins'])->name('liste-client');
    // chat
    // Route::get('/admins', [ChatController::class, 'showAdmins'])->name('chat.admins');
    Route::get('/chat-user/{client}', [ChatController::class, 'chatWithAdmin'])->name('chat.withClient');
    Route::post('/chat-user/{client}', [ChatController::class, 'sendMessage'])->name('chat.sendMessageClient');

});

Route::middleware('auth.client')->group(function () {
    // marché
    //déconnexion
    Route::post('/deconnexion', [AuthController::class, 'deconnexion'])->name('deconnexion');
    // accueil
    Route::get('/accueil', [ClientController::class, 'index'])->name('accueil');
    //chat
    Route::get('/liste-admin', [ChatController::class, 'showAdmins'])->name('liste-admin');
    // boutique
    Route::get('/boutique', [ClientController::class, 'boutique'])->name('boutique');
    //info
    Route::get('/info', [ClientController::class, 'information'])->name('info');
    
    //panier
    Route::get('/mon-panier', [ClientController::class, 'panier'])->name('mon-panier');
    Route::get('produit/{id}', [ProduitController::class, 'addProduct'])->name('ajouter-produit');
    Route::delete('annuler/{libelle}', [ProduitController::class, 'annulerProduit'])->name('annuler-produit');
    Route::post('/update-quantity/{id}', [ProduitController::class, 'updateQuantity'])->name('update-quantity');

    // chat
    // Route::get('/admins', [ChatController::class, 'showAdmins'])->name('chat.admins');
    Route::get('/chat/{admin}', [ChatController::class, 'chatWithAdmin'])->name('chat.withAdmin');
    Route::post('/chat/{admin}', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
   
    // payement
    Route::get('/moyen-payement', [ProduitController::class, 'pagePayement'])->name('page-payement');
   // commande
    Route::get('/page-commande', [ProduitController::class, 'pageCommande'])->name('page-commande');


});