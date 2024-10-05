<?php

use Chatify\ChatifyMessenger;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\GProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;

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
    return view('bienvenue');
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
    //déconnexion
    Route::post('/deconnexion-a', [AuthController::class, 'deconnexionA'])->name('deconnexion-a');

     // dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    //chat
    Route::get('/liste-client', [ChatController::class, 'showAdmins'])->name('liste-client');
    Route::get('/chat/client/{client}', [ChatController::class, 'chatWithClient'])->name('chat.withClient');
    Route::post('/chat/client/{client}', [ChatController::class, 'sendMessageToClient'])->name('chat.sendMessageClient');
    
    // concernant les categories
    Route::get('Categorie', [CategorieController::class, 'index'])->name('categorie');
    Route::resource('categories', CategorieController::class);
    Route::post('categories/{id}', [CategorieController::class, 'update'])->name('modifier');
    Route::delete('categories/{id}', [CategorieController::class, 'destroy'])->name('destroy');

    //Concernant les produits
    Route::get('produits', [ProduitController::class, 'index'])->name('produit.index');
    Route::post('ajout-produits', [ProduitController::class, 'store'])->name('produit.store');
    Route::post('produit/{id}', [ProduitController::class, 'update'])->name('modifierproduit');
    Route::delete('produit/{id}', [ProduitController::class, 'destroy'])->name('detruireproduit');
    Route::get('produit/{id}', [ProduitController::class, 'show'])->name('voir');

   //  docteur
   Route::resource('personnels', AdminController::class);
   // article
   Route::resource('articles', ArticleController::class);

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
    Route::get('/admins', [ChatController::class, 'showAdmins'])->name('admins.list');
    Route::get('/chat/admin/{admin}', [ChatController::class, 'chatWithAdmin'])->name('chat.withAdmin');
    Route::post('/chat/admin/{admin}', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');

    // payement
    Route::get('/moyen-payement', [ProduitController::class, 'pagePayement'])->name('page-payement');
   // commande
    Route::get('/page-commande', [ProduitController::class, 'pageCommande'])->name('page-commande');

}); 