<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function showAdmins()
    {
        $lien = 'accueil';
        $nom_page = 'Chat';
        $clients = Client::all();
        $admins = Admin::all(); // Obtenez tous les administrateurs
        return view('marche.liste_chat', compact('admins', 'clients', 'lien', 'nom_page'));
    }

    // Afficher le chat avec un administrateur
    public function chatWithAdmin(Admin $admin)
    {
        $lien = 'liste-admin';
        $nom_page = $admin->name;
        $client = Auth::guard('client')->user(); // Obtenez le client connecté
        $messages = Message::where(function ($query) use ($admin, $client) {
            $query->where('sender_id', $client->id)
                  ->where('receiver_id', $admin->id);
        })->orWhere(function ($query) use ($admin, $client) {
            $query->where('sender_id', $admin->id)
                  ->where('receiver_id', $client->id);
        })->get(); // Récupérer tous les messages entre le client et l'admin

        return view('marche.chat', compact('admin', 'messages', 'lien', 'client', 'nom_page'));
    }

    public function chatWithClient(Client $client)
    {
        $lien = 'liste-client';
        $nom_page = $client->pseudo;
        $admin = Auth::guard('admin')->user(); // Obtenez le client connecté
        $messages = Message::where(function ($query) use ($client, $admin) {
            $query->where('sender_id', $admin->id)
                  ->where('receiver_id', $client->id);
        })->orWhere(function ($query) use ($client, $admin) {
            $query->where('sender_id', $client->id)
                  ->where('receiver_id', $admin->id);
        })->get(); // Récupérer tous les messages entre le client et l'admin

        return view('marche.chat', compact('admin', 'messages', 'lien', 'client', 'nom_page'));
    }

    // Envoyer un message à l'administrateur
    public function sendMessage(Request $request, Admin $admin)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $client = Auth::guard('client')->user(); // Obtenez le client connecté

        Message::create([
            'sender_id' => $client->id, // ID du client
            'receiver_id' => $admin->id, // ID de l'admin
            'sender_type' => 'client', // Type de l'expéditeur
            'receiver_type' => 'admin', // Type du destinataire
            'message' => $request->message,
        ]);

        return redirect()->route('chat.withAdmin', $admin->id)->with('success', 'Message envoyé.');
    }

    // Envoyer un message au client
    public function sendMessageToClient(Request $request, Client $client)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $admin = Auth::guard('admin')->user(); // Obtenez l'admin connecté

        Message::create([
            'sender_id' => $admin->id, // ID de l'admin
            'receiver_id' => $client->id, // ID du client
            'sender_type' => 'admin', // Type de l'expéditeur
            'receiver_type' => 'client', // Type du destinataire
            'message' => $request->message,
        ]);

        return redirect()->route('chat.withClient', $client->id)->with('success', 'Message envoyé.');
    }
}
