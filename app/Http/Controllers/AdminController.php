<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        //
        $personnel = Admin::all();
        // $role = Role::all();
        return view('page_administration.personnel', compact('personnel'));
    }

    public function store(Request $request)
    {
        // Validation des données de la requête
        $dataValid = $request->validate([
            'name' => 'required',
            'specialite' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:8',
            // 'contact' => 'required',
            // 'role' => 'required',
            // 'image' => 'image|mimes:jpg,jpeg,png,svg'
        ], [
            'name.required' => 'Le champ nom est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.unique' => 'Cet nom d utilisateur est déjà utilisée par un autre utilisateur.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'contact.required' => 'Le champ contact est requis.',
            'role.required' => 'Le champ rôle est requis.',
            'image.required' => 'L\'image est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpg, jpeg, png ou svg.',
        ]);

        // Vérifier si l'utilisateur actuellement connecté a le rôle "gerant"
        // if (Auth::guard('admin')->user()->check()) {
        //     // L'utilisateur connecté est un "gerant", donc il ne peut attribuer que les rôles "gerant" et "vendeur"
        //     if ($dataValid['role'] == 'admin') {
        //         return back()->with('error', 'Vous n\'avez pas la permission d\'attribuer ce rôle.');
        //     }
        // }
        $idPersonnel = Auth::guard('admin')->user()->idAdmin;

            // Hasher le mot de passe
            $dataValid['password'] = bcrypt($dataValid['password']);

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

            // Ajouter l'ID de l'utilisateur au tableau de données validées
            // $dataValid['id_user'] = $idPersonnel;

            // Créer un nouvel utilisateur
            Admin::create($dataValid);
        
        return back()->with('success', 'Le docteur a été ajouté avec succès.');
    }

    public function show($id)
    {
        //
        $personnel= Admin::find($id);
        return view('page_administration.personnelShow', compact('personnel'));
    }

    public function edit($id)
    {
        //
        $personnel = Admin::find($id);
        return view('page_administration.personnelEdit', compact('personnel'));
    }

    public function update(Request $request, $id)
    {
        // Récupérer l'utilisateur que vous souhaitez mettre à jour
        $personnel = Admin::find($id);

        // Valider les données de la requête
        $dataValid = $request->validate([
            'name' => 'required',
            'specialite' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            // 'contact' => 'required',
            // 'role' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg'
        ]); 

        // Mettre à jour les propriétés de l'utilisateur avec les données validées
        $personnel->name = $dataValid['name'];
        $personnel->email = $dataValid['email'];
        $personnel->specialite = $dataValid['specialite'];
        // $personnel->password = bcrypt($dataValid['password']);
        // $personnel->contact = $dataValid['contact'];
        // $personnel->role = $dataValid['role'];

              // Gérer l'upload de l'image
        $image = $request->file('image');  
        if ($image) {
            // Le fichier a été téléversé avec succès
            // Vous pouvez maintenant procéder avec le traitement du fichier
            $imagePath = 'images/';
            $uniqueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imagePath, $uniqueImage);
            $personnel->image = $uniqueImage;
        } else {
            // Gérer le cas où aucun fichier n'a été téléversé
            // Par exemple, afficher un message d'erreur à l'utilisateur
            echo "Aucun fichier n'a été téléversé.";
        }
        // Sauvegarder les modifications dans la base de données
        $personnel->save();

        return back()->with('success', 'Le personnel a été modifié avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer l'utilisateur que vous souhaitez supprimer
        $personnel = Admin::find($id);

        if (!$personnel) {
            return back()->with('error', 'Le personnel n\'existe pas.');
        }

        // Supprimer l'utilisateur
        $personnel->delete();

        return back()->with('success', 'Le personnel a été supprimé avec succès.');
    }

}
