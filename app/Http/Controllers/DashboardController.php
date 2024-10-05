<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\commandes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // variable contenant les nombre d'enregistrement dans la base
        $count_utilisateur = Admin::count();
        $count_produit = Produit::count();
        $count_categorie = Categorie::count();
        $count_article = Article::count();

       if (Auth::guard('admin')->check()) {
            return view('page_administration.acceuil', compact('count_utilisateur', 'count_produit', 'count_categorie', 'count_article'));
        }
    }
}