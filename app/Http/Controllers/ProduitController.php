<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    //
    public function pagePayement()
    {
        $lien = 'mon-panier';
        $nom_page = 'Moyen de paiement';
        return view('marche.payement', compact('lien', 'nom_page'));
    }

    public function pageCommande()
    {
        $lien = 'mon-panier';
        $nom_page = 'Mes commande';
        return view('marche.commande', compact('lien', 'nom_page'));
    }

    public function addProduct($id)
    {
        $produits = Produit::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'libelle' => $produits->libelle,
                'description' => $produits->description,
                'quantity' => 1,
                'prix' => $produits->prix,
                'image' => $produits->image
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'le produit a été ajouté avec succès.');
    }

    public function annulerProduit(Request $request, $libelle)
    {
        // Récupérez le panier de session
        $cart = session('cart');
        if (empty($cart)) {
            return back()->with('error', 'Le panier est vide.');
        }

        foreach ($cart as $id => $details) {
            if ($details['libelle'] === $libelle) {
                // Supprimez le produit du panier
                unset($cart[$id]);

                // Mettez à jour la session avec le panier modifié
                session(['cart' => $cart]);

                return redirect()->back()->with('success', 'Le produit a été supprimé du panier.');
            }
        }

        return redirect()->back()->with('error', 'Le produit n\'existe pas dans le panier.');

    }

    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart');
        
        if ($request->action == 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($request->action == 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }
        
        session()->put('cart', $cart);
        return back()->with('success', 'La quantité a été mise à jour.');
    }

    public function update_produit(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Le produit a été ajouté.');
        }
    }

    public function validerCommande()
    {
        // Récupérez les éléments actuels du panier depuis la session
        $panier = session('cart');
        $idPersonnel = Auth::user()->name;

        if (empty($panier)) {
            return redirect()->back()->with('error', 'Le panier est vide.');
        }

        // Initialiser un tableau pour stocker les produits atteignant le stock critique
        $produitsStockCritique = [];

        foreach ($panier as $id => $details) {
            $produit = Produits::find($id);

            // Vérifier si le stock est inférieur ou égal à 0
            if ($produit->stock_produit <= 0) {
                // Stock épuisé pour ce produit, stockez-le dans le tableau et bloquez l'exécution ici
                $produitsStockCritique[] = $produit->libelle;
                return redirect()->back()->with('error', 'Stock épuisé pour le produit : ' . $produit->libelle);
            }

            if ($produit->stock_produit - $details['quantity'] < $produit->stock_critique) {
                // Stock critique atteint pour ce produit, stockez-le dans le tableau
                $produitsStockCritique[] = $produit->libelle;
            }
        }

        // Traiter les produits atteignant le stock critique ici
        if (!empty($produitsStockCritique)) {
            // Vous pouvez les stocker dans la session pour les pr$produits ultérieurement
            session()->put('produitsStockCritique', $produitsStockCritique);

            // Ou envoyer un message à l'utilisateur pour l'informer que certains produits ont atteint le stock critique
            // flash()->error('Certains produits ont atteint le stock critique.');
        }

        // Enregistrez les éléments du panier dans la table d'historique
        foreach ($panier as $id => $details) {
            $produit = Produits::find($id);

            // Vérifier si le stock est supérieur à 0 avant d'enregistrer la commande
            if ($produit->stock_produit > 0) {
                commandes::create([
                    'produit_commande' => $details['libelle'],
                    'quantite_commande'=> $details['quantity'],
                    'id_user' => $idPersonnel,
                    'total_commande' => $details['prix'] * $details['quantity'],
                    // ... Ajoutez d'autres colonnes d'historique si nécessaire
                ]);

                // Mettre à jour le stock du produit
                $produit->stock_produit -= $details['quantity'];
                $produit->save();
            }
        }

        // Vider le panier actuel
        session()->forget('cart');

        // Redirigez l'utilisateur vers une page de confirmation 
        return back()->with('success', 'Commande validée avec succès');
    }
}
