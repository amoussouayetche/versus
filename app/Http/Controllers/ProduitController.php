<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\PostTooLargeException;

class ProduitController extends Controller
{
    //
    public function index()
    {
        //
        $produits = Produit::get();
        $categories = Categorie::get();
        return view('page_administration.produit.produit', compact('produits', 'categories'));
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                // 'libelle' => 'required|unique:produits,libelle',
                'libelle' => 'required',
                'description' => 'required',
                'prix' => 'required|numeric',
                'categorie' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:4096'
            ], [
                'libelle.required' => 'Le champ libellé du produit est requis.',
                'libelle.unique' => 'Ce libelle du produit existe déjà.',
                'prix.required' => 'Le champ prix du produit est requis.',
                'prix.numeric' => 'Le champ prix du produit doit être un nombre.', // Message d'erreur personnalisé
                'categorie.required' => 'Le champ catégorie du produit est requis.',
                'image.required' => 'L\'image du produit est requise.',
                'image.image' => 'Le fichier doit être une image.',
                'image.max' => 'L\'image doit faire au maximum 4 Mo.',
                'image.mimes' => 'L\'image doit être au format jpg, jpeg, png ou svg.',
            ]);
    
            $idAdmin = Auth::guard('admin')->user()->id;
    
            $image = $request->file('image');
            $imagePath = 'images/';
            $uniqueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imagePath, $uniqueImage);
            $validatedData['image'] = $uniqueImage;
    
            // Ajoutez l'ID de l'utilisateur au tableau de données validées
            // $validatedData['id_admin'] = $idAdmin;
            Produit::create($validatedData);
    
            return back()->with('success', 'Produit ajouté avec succès');
        } catch (PostTooLargeException $e) {
            return back()->withErrors(['image' => 'Le fichier que vous essayez de télécharger est trop volumineux.']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue.']);
        }
    }
    

    public function show($id)
    {
        $produits = Produit::where('id', $id)->first();

        if (!$produits) {
            abort(404);
        }

        return view('produit.show', compact('produits'));
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'categorie' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg',
        ]);

        // Obtenez l'élément à mettre à jour en fonction de l'ID
        $element = Produit::find($id);

        if (!$element) {
            // Gérez le cas où l'élément n'a pas été trouvé (ID invalide, par exemple)
            return redirect()->route('produit.index')->with('error', 'L\'élément n\'existe pas.');
        }

        // Mettez à jour l'image uniquement si elle est fournie
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'images/';
            $uniqueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imagePath, $uniqueImage);
            $element->image = $uniqueImage;
        }

        // Mettez à jour les autres champs
        $element->libelle = $request->libelle;
        $element->description = $request->description;
        $element->prix = $request->prix;
        $element->categorie = $request->categorie;

        $element->save();

        // Redirigez l'utilisateur ou renvoyez une réponse JSON appropriée
        return redirect()->route('produit.index')->with('success', 'L\'élément a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $element = Produit::where('id', $id)->first();

        if (!$element) {
            return redirect()->route('produit.index')->with('error', 'Le produit que vous essayez de supprimer n\'existe pas.');
        }

        // L'élément existe, vous pouvez le supprimer en toute sécurité
        $element->delete();

        return redirect()->route('produit.index')->with('success', 'Produit supprimé avec succès');
    }

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
        $produit = Produit::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'libelle' => $produit->libelle,
                'description' => $produit->description,
                'quantity' => 1,
                'prix' => $produit->prix,
                'image' => $produit->image
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
}
