<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClientsController extends Controller
{
    public function markAllAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();
        //return vide
        return response()->json([], 204);
    }

    // Pour afficher la liste des clients
    public function index(Request $request)
    {
        $search = $request->input('search');
        $remboursementDepasse = $request->has('remboursementDepasse');

        $clients = Client::query();

        if ($search) {
            $clients->where(function($query) use ($search) {
                $query->where('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('telephone', 'LIKE', "%{$search}%")
                    ->orWhere('adresse', 'LIKE', "%{$search}%");
            });
        }

        if ($remboursementDepasse) {
            $tomorow = Carbon::tomorrow()->toDateString();
            $clients->where('date_remboursement', '<=', $tomorow);
        }

        $clients = $clients->paginate(7);

        return view('clients.index', compact('clients'));
    }


    // Pour afficher le formulaire de création d'un nouveau client
    public function create()
    {
        return view('clients.create');
    }

    // Pour enregistrer un nouveau client dans la base de données
    public function store(Request $request)
    {
        $validatedData = $request->all();

        Client::create($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }



    // Pour afficher le formulaire de modification d'un client existant
    public function edit($id)
    {
        $client = Client::findOrFail($id); // Utilisation de findOrFail pour gérer le cas où l'ID n'existe pas
        return view('clients.edit', ['client' => $client]); // Correction du nom de la vue 'clients.update' à 'clients.edit'
    }

    // Pour mettre à jour un client dans la base de données
    public function update(Request $request, $id){
        $validatedData = $request->all();

        $client = Client::find($id);
        $client->update($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }


    // Pour supprimer un client de la base de données
    public function destroy($id){
        $client = Client::find($id);
        if ($client) {
            // Supprimez d'abord toutes les relations
            $client->payements()->delete();
            $client->articles()->delete();
            $client->supplementaires()->delete();

            // Puis, supprimez le client lui-même
            $client->delete();

            return redirect()->route('clients.index')->with('success', 'Client et toutes les données associées supprimés avec succès.');
        }

        return redirect()->route('clients.index')->with('error', 'Client introuvable.');
    }

}
