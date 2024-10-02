<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Article;
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
            $articles = Article::get();
            $admins = Admin::get();
            $produits = Produit::get();
            return view('marche.accueil', compact('clients', 'produits', 'admins', 'articles'));
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
        $lien = 'accueil';
        $nom_page = 'Information';
        return view('marche.info', compact('lien', 'nom_page'));
    }

    public function panier()
    {
        $lien = 'boutique';
        $nom_page = 'Mon panier';
        return view('marche.panier', compact('nom_page', 'lien'));
    }
}
