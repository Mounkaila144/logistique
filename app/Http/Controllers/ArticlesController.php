<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Pour afficher la liste des articles
    public function index()
    {
        $articles = Article::paginate(7); // Paginer les articles, 10 par page
        return view('articles.index', compact('articles'));
    }


    // Pour afficher le formulaire de création d'un nouveau article
    public function create()
    {
        return view('articles.create');
    }

    // Pour enregistrer un nouveau article dans la base de données
    public function store(Request $request)
    {
        $validatedData = $request->all();

        Article::create($validatedData);

        return redirect()->route('payements.index', ['client_id' => $request->client_id])->with('success', 'Article ajouté avec succès.');
    }



    // Pour afficher le formulaire de modification d'un article existant
    public function edit($id)
    {
        $article = Article::findOrFail($id); // Utilisation de findOrFail pour gérer le cas où l'ID n'existe pas
        return view('articles.edit', ['article' => $article]); // Correction du nom de la vue 'articles.update' à 'articles.edit'
    }

    // Pour mettre à jour un article dans la base de données
    public function update(Request $request, $id){
        $validatedData = $request->all();

        $article = Article::find($id);
        $article->update($validatedData);

        return redirect()->route('payements.index', ['client_id' => $request->client_id])->with('success', 'Article mis à jour avec succès.');
    }


    // Pour supprimer un article de la base de données
    public function destroy($id, Request $request){
        $article = Article::find($id);
        if ($article) {

            // Puis, supprimez le article lui-même
            $article->delete();

            return redirect()->route('payements.index', ['client_id' => $request->client_id])->with('success', 'Article et toutes les données associées supprimés avec succès.');
        }

        return redirect()->route('payements.index', ['client_id' => $request->client_id])->with('error', 'Article introuvable.');
    }

}
