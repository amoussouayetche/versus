<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function pageInscription()
    {
        $lien = 'page-connexion';
        $nom_page = 'Inscription';
        // retourner la page d'inscription
        return view('auth.inscription', compact('lien', 'nom_page'));
    }

    public function pageConnexion()
    {
        $lien = 'page-inscription';
        // retourner la page de connexion
        return view('auth.connexion', compact('lien'));
    }

    public function pageCondition($clientId)
    {
        // Récupérer l'utilisateur à partir de son ID
        $client = Client::findOrFail($clientId);
        $lien = 'page-inscription';
        $nom_page = 'Inscription';
        // retourner la page d'acceptation de la condition d'utilisation
        return view('auth.conditionUtilisation', compact('lien', 'client', 'nom_page'));
    }

    public function pageOtp()
    {
        $lien = 'page-otp';
        $nom_page = 'Vérification';
        // retourner la page OTP une fois les condition accepté
        return view('auth.otp', compact('lien', 'nom_page'));
    }

    // fonction d'inscription
    public function inscription(Request $request)
    {
        $validatedData = $request->validate([
            'pseudo' => 'required|unique:clients,pseudo',
            'tel' => 'required|unique:clients,tel',
            'genre' => 'required',
            'naissance' => ['required', 'date', 'before_or_equal:-9 months'],
            'password' => 'required|min:8|confirmed',
            'condition' => 'boolean|required',
        ], [
            'pseudo.required' => 'Veuillez remplir ce champs.',
            'tel.required' => 'Veuillez remplir ce champs.',
            'genre.required' => 'Veuillez remplir ce champs.',
            'naissance.required' => 'Veuillez remplir ce champs.',
            'password.required' => 'Veuillez remplir ce champs.',
            'condiftion.required' => 'Veuillez remplir ce champs.',
            'tel.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'pseudo.unique' => 'Ce pseudo est déjà utilisé.',
            'tel.numeric' => 'Ce numéro est déjà utilisé.',
            'genre.string' => 'Ce champs doit contrenir une chaîne de caractère.',
            'naissance.date' => 'Ce champs doit contenir une date.',
            'naissance.before_or_equal' => 'Cette date de naissance est invalide.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractère.',
            'password.confirmed' => 'Les mot de passe ne corespondent pas.',
        ]);

        $client = Client::create([
            'pseudo' => $validatedData['pseudo'],
            'tel' => $validatedData['tel'],
            'genre' => $validatedData['genre'],
            'naissance' => $validatedData['naissance'],
            'password' => bcrypt($validatedData['password']),
            'condition' => $validatedData['condition'],
        ]);
        
        // Insérer également les informations du client dans la table 'users' de la base de données 'chatsystem'
        DB::connection('mysql_chat')->table('users')->insert([
            'name' => $validatedData['pseudo'],  // Utiliser 'pseudo' pour le nom
            'email' => $validatedData['tel'],    // Utiliser le numéro de téléphone comme email ou identifiant unique
            'password' => bcrypt($validatedData['password']), // Hasher le mot de passe
            'role' => 'client',  // Ajouter un rôle pour identifier cet utilisateur comme client
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('page-condition', ['client' => $client->id]);
    }

    public function condition(Request $request, $clientId)
    {
        // Récupérer le client
        $client = Client::findOrFail($clientId);
        // Vérifier si l'utilisateur accepte les conditions
        if ($request->has('condition')) {
            // Mettre à jour la colonne condition à true
            $client->update(['condition' => 1]);
            // Rediriger vers une autre page (par exemple tableau de bord ou accueil)
            return redirect()->route('page-connexion')->with('success', 'Vous avez accepté les conditions.');
        }

        return redirect()->back()->withErrors('Vous devez accepter les conditions pour continuer.');
    }

    public function connexion(Request $request)
    {
        // Valider les données pour le pseudo et mot de passe
        $credentials = $request->validate([
            'pseudo' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'pseudo.required' => 'Veuillez entrer votre pseudo.',
            'password.required' => 'Veuillez entrer votre mot de passe.',
        ]);
    
        // Vérifier si c'est un pseudo pour le guard 'client'
        if (Auth::guard('client')->attempt(['pseudo' => $credentials['pseudo'], 'password' => $credentials['password']])) {
            // Si la connexion réussit avec le guard 'client'
            $request->session()->regenerate();
            return redirect()->intended('accueil')->with('success', 'Connexion réussie.');
        }
        
        // Si la connexion avec le pseudo échoue, tenter la connexion avec un email pour le guard par défaut (ex: web/admin)
        if (Auth::guard('admin')->attempt(['email' => $credentials['pseudo'], 'password' => $credentials['password']])) {
            // Si la connexion réussit avec le guard par défaut
            $request->session()->regenerate();
            return redirect()->intended('liste-client')->with('success', 'Connexion réussie.');
        }
    
        // Si aucune tentative ne fonctionne, retourner un message d'erreur
        return back()->withInput([
            'pseudo' => $credentials['pseudo'],
        ])->withErrors([
            'pseudo' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
    
    public function deconnexion(Request $request)
    {
        if (Auth::guard('client')->check()) {
            Auth::guard('client')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } 
       
        return redirect('/page-connexion'); // Redirige vers la page d'accueil après la déconnexion
    }

    public function deconnexionA(Request $request)
    {
       if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
       
        return redirect('/page-connexion'); // Redirige vers la page d'accueil après la déconnexion
    }

}