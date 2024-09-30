<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\ChatMessageEvent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function showAdmins()
    {
        $lien = 'accueil';
        $nom_page = 'Chat';
        $clients = Client::get();
        $admins = Admin::get(); // Obtenez tous les administrateurs
        return view('marche.liste_chat', compact('admins', 'clients', 'lien', 'nom_page'));
    }

     // Afficher le chat avec un administrateur
     public function chatWithAdmin(Admin $admin, Client $client)
     {
        $lien = 'liste-admin';

        if (Auth::guard('client')->check()) {
        $nom_page = $admin->name;
            $messages = Message::where(function ($query) use ($admin) {
                $query->where('sender_id', Auth::guard('client')->id())
                      ->where('receiver_id', $admin->id);
            })->orWhere(function ($query) use ($admin) {
                $query->where('sender_id', $admin->id)
                      ->where('receiver_id', Auth::guard('admin')->id());
            })->get(); // Récupérer tous les messages entre le client et l'admin
    
        } else if (Auth::guard('admin')->check()) {
            $nom_page = $client->pseudo;
            $messages = Message::where(function ($query) use ($client) {
                $query->where('sender_id', Auth::guard('admin')->id())
                      ->where('receiver_id', $client->id);
            })->orWhere(function ($query) use ($client) {
                $query->where('sender_id', $client->id)
                      ->where('receiver_id', Auth::guard('admin')->id());
            })->get();  
        }
        
         return view('marche.chat', compact('admin', 'messages', 'lien', 'nom_page', 'client'));
     }
 
     // Envoyer un message à l'administrateur
     public function sendMessage(Request $request, Admin $admin, Client $client)
     {
        $request->validate([
            'message' => 'required|string',
        ]);
        if (Auth::guard('client')->check()) {
            // Vérifier si l'utilisateur est authentifié en tant que client
            Message::create([
                'sender_id' => Auth::guard('client')->id(), // ID du client
                'receiver_id' => $admin->id, // ID de l'admin
                'message' => $request->message,
            ]);
            return redirect()->route('chat.withAdmin', $admin->id)->with('success', 'Message envoyé.');

        } elseif (Auth::guard('admin')->check()) {
            // Vérifier si l'utilisateur est authentifié en tant qu'admin
            Message::create([
                'sender_id' => Auth::guard('admin')->id(), // ID de l'admin
                'receiver_id' => $client->id, // ID du client
                'message' => $request->message,
            ]);
            return redirect()->route('chat.withClient', $client->id)->with('success', 'Message envoyé.');

        } else {
            // Si aucun utilisateur n'est authentifié, retour à la page de connexion
            return redirect()->route('page-connexion')->withErrors(['error' => 'Utilisateur non connecté.']);
        }
         
     }

   
}
