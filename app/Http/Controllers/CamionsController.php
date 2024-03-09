<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CamionsController extends Controller
{

    // Pour afficher la liste des camions
    public function index(Request $request)
    {
        $search = $request->input('search');
        $remboursementDepasse = $request->has('remboursementDepasse');

        $camions = Camion::query();

        if ($search) {
            $camions->where(function($query) use ($search) {
                $query->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('montant', 'LIKE', "%{$search}%");
            });
        }

        if ($remboursementDepasse) {
            $tomorow = Carbon::tomorrow()->toDateString();
            $camions->where('date_remboursement', '<=', $tomorow);
        }

        $camions = $camions->paginate(7);

        return view('camions.index', compact('camions'));
    }



    // Pour afficher le formulaire de création d'un nouveau camion
    public function create()
    {
        return view('camions.create');
    }

    // Pour enregistrer un nouveau camion dans la base de données
    public function store(Request $request)
    {
        $validatedData = $request->all();

        Camion::create($validatedData);

        return redirect()->route('camions.index')->with('success', 'Camion ajouté avec succès.');
    }



    // Pour afficher le formulaire de modification d'un camion existant
    public function edit($id)
    {
        $camion = Camion::findOrFail($id); // Utilisation de findOrFail pour gérer le cas où l'ID n'existe pas
        return view('camions.edit', ['camion' => $camion]); // Correction du nom de la vue 'camions.update' à 'camions.edit'
    }

    // Pour mettre à jour un camion dans la base de données
    public function update(Request $request, $id){
        $validatedData = $request->all();

        $camion = Camion::find($id);
        $camion->update($validatedData);

        return redirect()->route('camions.index')->with('success', 'Camion mis à jour avec succès.');
    }


    // Pour supprimer un camion de la base de données
    public function destroy($id){
        $camion = Camion::find($id);
        if ($camion) {
            // Supprimez d'abord toutes les relations
            $camion->donnes()->delete();
            // Puis, supprimez le camion lui-même
            $camion->delete();

            return redirect()->route('camions.index')->with('success', 'Camion et toutes les données associées supprimés avec succès.');
        }

        return redirect()->route('camions.index')->with('error', 'Camion introuvable.');
    }

}
