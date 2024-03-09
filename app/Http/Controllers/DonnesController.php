<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use App\Models\Donne;
use Illuminate\Http\Request;

class DonnesController extends Controller
{
    //entregistrer la date de remboursement du camion si ca exist met le a jour
    public function remboursement(Request $request)
    {
        $camion = Camion::findOrFail($request->camion_id);
        $camion->date_remboursement = $request->date_remboursement;
        $camion->save();
        return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])->with('success', 'Date de remboursement enregistrée avec succès.');
    }
    public function download($id)
    {
        $camionId = $id;
        $camion = Camion::with(['donnes'])->findOrFail($camionId);

        $totalDonnes = $camion->totaldonnes();
        $restant = $camion->restant();
        return view('factures.factures', compact('camion', 'totalDonnes', 'restant'));
    }
    // Pour afficher la liste des donnes
    public function index(request $request)
    {
        $camion = Camion::with(['donnes'])->findOrFail($request->camion_id);

        $camionId = $request->query('camion_id');
        $donnes = Donne::where('camion_id', $camionId)->get(); // Paginer les donnes, 7 par page
        return view('donnes.index', compact('donnes', 'camionId','camion'));

    }


    // Pour afficher le formulaire de création d'un nouveau donne
    public function create()
    {
        return view('donnes.create');
    }

    // Pour enregistrer un nouveau donne dans la base de données
    public function store(Request $request)
    {
        $camion = Camion::with(['donnes'])->findOrFail($request->camion_id);
        $totalDonnes = $camion->totaldonnes();
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'camion_id' => 'required|exists:camions,id',
        ]);
        if ($totalDonnes + $request->montant > $camion->montant) {
            return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])
                ->with('error', 'Le montant total des donnes ne peut pas dépasser le montant total des Camions.');
        }
        //gerer les montant negatif
        if ($request->montant < 0) {
            return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])
                ->with('error', 'Le montant ne peut pas être négatif.');
        }

        Donne::create($validatedData);


        return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])
            ->with('success', 'Paiement ajouté avec succès.');
    }




    // Pour afficher le formulaire de modification d'un donne existant
    public function edit($id)
    {
        $donne = Donne::findOrFail($id); // Utilisation de findOrFail pour gérer le cas où l'ID n'existe pas
        return view('donnes.edit', ['donne' => $donne]); // Correction du nom de la vue 'donnes.update' à 'donnes.edit'
    }

    // Pour mettre à jour un donne dans la base de données
    public function update(Request $request, $id){
        $camion = Camion::with(['donnes'])->findOrFail($request->camion_id);
        $totalDonnes = $camion->totaldonnes();
        $donne = Donne::findOrFail($id);
        if ($totalDonnes + $request->montant - $donne->montant  > $camion->montant) {
            return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])
                ->with('error', 'Le montant total des donnes ne peut pas dépasser le montant total des .');
        }
        //gerer les montant negatif
        if ($request->montant < 0) {
            return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])
                ->with('error', 'Le montant ne peut pas être négatif.');
        }
        $validatedData = $request->all();


        $donne->update($validatedData);

        return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])->with('success', 'Donne mis à jour avec succès.');
    }


    // Pour supprimer un donne de la base de données
    public function destroy($id, Request $request){
        $donne = Donne::find($id);
        $camion = Camion::findOrFail($request->camion_id);
        if ($donne) {
            // Puis, supprimez le donne lui-même
            $donne->delete();

            return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])->with('success', 'Donne et toutes les données associées supprimés avec succès.');
        }

        return redirect()->route('donnes.index', ['camion_id' => $request->camion_id,'camion'=>$camion])->with('error', 'Donne introuvable.');
    }

}
