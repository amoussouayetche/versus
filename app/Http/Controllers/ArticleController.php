<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index()
    {
        //
        $articles = Article::all();
        // $role = Role::all();
        return view('page_administration.article.article', compact('articles'));
    }

    public function store(Request $request)
    {
        // Validation des données de la requête
        $dataValid = $request->validate([
            'libelle' => 'required',
            'resume' => 'required',
            'lien' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg'
        ], [
            'libelle.required' => 'Le champ libelle est requis.',
            'resume.required' => 'Le champ resume est requis.',
            'lien.required' => 'Le lien est requis.',
            'image.required' => 'L\'image est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpg, jpeg, png ou svg.',
        ]);

            // Générer un nom de fichier unique pour l'image
            $image = $request->file('image');

            if ($image) {
                // Le fichier a été téléversé avec succès
                // Vous pouvez maintenant procéder avec le traitement du fichier
                $imagePath = 'images/';
                $uniqueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($imagePath, $uniqueImage);
                $dataValid['image'] = $uniqueImage;
            } else {
                // Gérer le cas où aucun fichier n'a été téléversé
                // Par exemple, afficher un message d'erreur à l'utilisateur
                echo "Aucun fichier n'a été téléversé.";
            }

            // Créer un nouvel utilisateur
            Article::create($dataValid);
        
        return back()->with('success', 'L\'article a été ajouté avec succès.');
    }

    public function show($id)
    {
        //
        $articles= Article::find($id);
        return view('page_administration.article.personnelShow', compact('articles'));
    }

    public function edit($id)
    {
        //
        $articles = Article::find($id);
        return view('page_administration.article.personnelEdit', compact('articles'));
    }

    public function update(Request $request, $id)
    {
        // Récupérer l'utilisateur que vous souhaitez mettre à jour
        $articles = Article::find($id);

        // Valider les données de la requête
        $dataValid = $request->validate([
            'libelle' => 'required',
            'resume' => 'required',
            'lien' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg'
        ]); 

        // Mettre à jour les propriétés de l'utilisateur avec les données validées
        $articles->libelle = $dataValid['libelle'];
        $articles->resume = $dataValid['resume'];
        $articles->lien = $dataValid['lien'];
      
        // Gérer l'upload de l'image
        $image = $request->file('image');  
        if ($image) {
            // Le fichier a été téléversé avec succès
            // Vous pouvez maintenant procéder avec le traitement du fichier
            $imagePath = 'images/';
            $uniqueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imagePath, $uniqueImage);
            $articles->image = $uniqueImage;
        } else {
            // Gérer le cas où aucun fichier n'a été téléversé
            // Par exemple, afficher un message d'erreur à l'utilisateur
            echo "Aucun fichier n'a été téléversé.";
        }
        // Sauvegarder les modifications dans la base de données
        $articles->save();

        return back()->with('success', 'L\'articles a été modifié avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer l'utilisateur que vous souhaitez supprimer
        $article = Article::find($id);

        if (!$article) {
            return back()->with('error', 'L\'article n\'existe pas.');
        }

        // Supprimer l'utilisateur
        $article->delete();

        return back()->with('success', 'L\'article a été supprimé avec succès.');
    }
}
