<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        //
        $personnel = Admin::all();
        // $role = Role::all();
        return view('page_administration.docteur.personnel', compact('personnel'));
    }

    public function store(Request $request)
    {
        // Validation des données de la requête
        $dataValid = $request->validate([
            'name' => 'required',
            'specialite' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:8',
            // 'role' => 'required',
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



        // $idPersonnel = Auth::guard('admin')->user()->idAdmin;

            // Hasher le mot de passe
            $dataValid['password'] = bcrypt($dataValid['password']);

            // Générer un nom de fichier unique pour l'image
            $image = $request->file('image');

            if ($image) {
                // Le fichier a été téléversé avec succès
                // Vous pouvez maintenant procéder avec le traitement du fichier
                $imagePath = 'images/';
                $uniqueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move(public_path($imagePath), $uniqueImage);                       
                $dataValid['image'] = $uniqueImage;
            } else {
                // Gérer le cas où aucun fichier n'a été téléversé
                // Par exemple, afficher un message d'erreur à l'utilisateur
                echo "Aucun fichier n'a été téléversé.";
            }

            // Créer un nouvel utilisateur
            $admin = Admin::create($dataValid);

            User::create([
                    'name' => $admin->name,          
                    'email' => $admin->email,        
                    'password' => $admin->password,  
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            // Insérer dans la table users de la base 'chatsystem'
            // DB::connection('mysql_chat')->table('users')->insert([
            //     'name' => $admin->name,          
            //     'email' => $admin->email,        
            //     'password' => $admin->password,  
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]);

        
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
            $image->move(public_path($imagePath), $uniqueImage);                       
            $personnel->image = $uniqueImage;
        } else {
            // Gérer le cas où aucun fichier n'a été téléversé
            // Par exemple, afficher un message d'erreur à l'utilisateur
            echo "Aucun fichier n'a été téléversé.";
        }
        // Sauvegarder les modifications dans la base de données
        $personnel->save();

        DB::table('users')
        ->where('email', $personnel->email)  // Trouver l'utilisateur par email ou un autre identifiant unique
        ->update([
            'name' => $personnel->name,
            'email' => $personnel->email,
            'updated_at' => now(),
        ]);
        // Mettre à jour également dans la table 'users' de la base de données 'chatsystem'
        // DB::connection('mysql_chat')->table('users')
        // ->where('email', $personnel->email)  // Trouver l'utilisateur par email ou un autre identifiant unique
        // ->update([
        //     'name' => $personnel->name,
        //     'email' => $personnel->email,
        //     'updated_at' => now(),
        // ]);

        return back()->with('success', 'Le personnel a été modifié avec succès.');
    }

   public function destroy($id)
    {
        // Récupérer l'administrateur que vous souhaitez supprimer
        $personnel = Admin::find($id);

        if (!$personnel) {
            return back()->with('error', 'Le personnel n\'existe pas.');
        }

        // Supprimer l'utilisateur de la base de données 'venus'
        $personnel->delete();

        DB::table('users')
        ->where('email', $personnel->email)  // Trouver l'utilisateur par email ou un autre identifiant unique
        ->delete();
        // Supprimer également de la table 'users' dans la base de données 'chatsystem'
        // DB::connection('mysql_chat')->table('users')
        //     ->where('email', $personnel->email)  // Trouver l'utilisateur par email ou un autre identifiant unique
        //     ->delete();

        return back()->with('success', 'Le personnel a été supprimé avec succès.');
    }

}
