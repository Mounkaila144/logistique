<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Client;
use App\Models\Payement;
use App\Models\User;
use App\Notifications\Remboursement;
use Illuminate\Http\Request;

class PayementsController extends Controller
{
    //entregistrer la date de remboursement du client si ca exist met le a jour
    public function remboursement(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        $client->date_remboursement = $request->date_remboursement;
        $client->save();
        return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])->with('success', 'Date de remboursement enregistrée avec succès.');
    }
    public function download($id)
    {
        $clientId = $id;
        $client = Client::with(['payements', 'articles'])->findOrFail($clientId);

        $totalPayements = $client->totalpayements();
        $totalArticle = $client->totalArticle();
        $restant = $client->restant();
        return view('factures.factures', compact('client', 'totalPayements', 'totalArticle', 'restant'));
    }
    // Pour afficher la liste des payements
    public function index(request $request)
    {
        $client = Client::with(['payements', 'articles'])->findOrFail($request->client_id);

        $clientId = $request->query('client_id');
        $payements = Payement::where('client_id', $clientId)->get(); // Paginer les payements, 7 par page
        $articles = Article::where('client_id', $clientId)->get(); // Paginer les payements, 7 par page
        return view('payements.index', compact('payements','articles', 'clientId','client'));

    }


    // Pour afficher le formulaire de création d'un nouveau payement
    public function create()
    {
        return view('payements.create');
    }

    // Pour enregistrer un nouveau payement dans la base de données
    public function store(Request $request)
    {
        $client = Client::with(['payements', 'articles'])->findOrFail($request->client_id);
        $totalPayements = $client->totalpayements();
        $totalArticle = $client->totalArticle();
        // $totalPayements ne dois pas depasser $totalArticle
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'client_id' => 'required|exists:clients,id',
        ]);
        if ($totalPayements + $request->montant > $totalArticle) {
            return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])
                ->with('error', 'Le montant total des payements ne peut pas dépasser le montant total des articles.');
        }
        // lorsque $totalPayements + $request->montant = $totalArticle metre client->date_remboursement a null
        if ($totalPayements + $request->montant == $totalArticle) {
            $client->date_remboursement = null;
            $client->save();
        }


        //gerer les montant negatif
        if ($request->montant < 0) {
            return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])
                ->with('error', 'Le montant ne peut pas être négatif.');
        }
//        $client = Client::findOrFail(5); // Adaptez cette requête à vos besoins
//        $adminUser = User::first(); // Obtenez le premier utilisateur
//        $adminUser->notify(new Remboursement($client));
        Payement::create($validatedData);


        return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])
            ->with('success', 'Paiement ajouté avec succès.');
    }




    // Pour afficher le formulaire de modification d'un payement existant
    public function edit($id)
    {
        $payement = Payement::findOrFail($id); // Utilisation de findOrFail pour gérer le cas où l'ID n'existe pas
        return view('payements.edit', ['payement' => $payement]); // Correction du nom de la vue 'payements.update' à 'payements.edit'
    }

    // Pour mettre à jour un payement dans la base de données
    public function update(Request $request, $id){
        $client = Client::with(['payements', 'articles'])->findOrFail($request->client_id);
        $totalPayements = $client->totalpayements();
        $totalArticle = $client->totalArticle();
        $payement = Payement::findOrFail($id);
        if ($totalPayements + $request->montant - $payement->montant  > $totalArticle) {
            return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])
                ->with('error', 'Le montant total des payements ne peut pas dépasser le montant total des articles.');
        }
        //gerer les montant negatif
        if ($request->montant < 0) {
            return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])
                ->with('error', 'Le montant ne peut pas être négatif.');
        }
        $validatedData = $request->all();


        $payement->update($validatedData);

        return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])->with('success', 'Payement mis à jour avec succès.');
    }


    // Pour supprimer un payement de la base de données
    public function destroy($id, Request $request){
        $payement = Payement::find($id);
        $client = Client::findOrFail($request->client_id);
        if ($payement) {
            // Puis, supprimez le payement lui-même
            $payement->delete();

            return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])->with('success', 'Payement et toutes les données associées supprimés avec succès.');
        }

        return redirect()->route('payements.index', ['client_id' => $request->client_id,'client'=>$client])->with('error', 'Payement introuvable.');
    }

}
