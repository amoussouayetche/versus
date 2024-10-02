<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    public function index()
    {
        $categories = Categorie::get();
        return view('page_administration.categorie', compact("categories"));
        //
    }

    public function create(Request $request)
    {
        Categorie::created(["libelle" => $request->libelle,]);
        return back();
        //
    }

    public function store(Request $request)
    {
        // Étape 1 : Validation des données de la requête
        $validatedData = $request->validate([
            'libelle' => 'required|unique:categories,libelle',
        ], [
            'libelle.unique' => 'Ce libelle est déjà utilisé.'
        ]);

        // Étape 2 : Récupération de l'ID de l'utilisateur connecté
        // $userId = Auth::user()->id_utilisateur;

        Categorie::create([
            'libelle' => $validatedData['libelle'],
            // 'id_user' => $userId,
        ]);

        return back()->with('success', 'Catégorie ajoutée avec succès');
    }

    public function update(Request $request, $id)
    {
        // Validation des données de la requête
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        // Recherche de l'élément avec l'ID correspondant
        $element = Categorie::find($id);

        if (!$element) {
            // Gérez le cas où l'élément n'a pas été trouvé
                   // Étape 3 : Création de la catégorie
        return redirect()->route('categories.index')->with('error', 'L\'élément n\'existe pas.');
        }

        // Mise à jour du nom de la catégorie
        $element->libelle = $request->libelle;

        $element->save();

        return redirect()->route('categories.index')->with('success', 'L\'élément a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Recherche de l'élément avec l'ID correspondant
        $element = Categorie::find($id);

        if (!$element) {
            // Gérez le cas où l'élément n'a pas été trouvé
            return redirect()->route('categories.index')->with('error', 'L\'élément n\'existe pas.');
        }

        // Suppression de la catégorie
        $element->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès');
    }

}
