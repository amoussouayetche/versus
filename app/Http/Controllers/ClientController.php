<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //
    public function index()
    {
        if (Auth::guard('client')->check()) {
            $clients = Client::get();
            return view('marche.accueil', compact('clients'));
        }
    }

    public function pageChat()
    {
        $lien = 'chat';
        $nom_page = 'Chat';
        $admins = User::get(); // Obtenez tous les administrateurs
        return view('marche.liste_chat', compact('admins', 'lien', 'nom_page'));
    }

    public function boutique()
    {
        $lien = 'accueil';
        $nom_page = 'Boutique';

        $produits = Produit::get();
        $categories = Categorie::get();
        return view('marche.boutique', compact('nom_page', 'lien', 'produits', 'categories'));
    }

    public function information()
    {
        return view('marche.info');
    }

    public function panier()
    {
        $lien = 'boutique';
        $nom_page = 'Mon panier';
        return view('marche.panier', compact('nom_page', 'lien'));
    }
}
