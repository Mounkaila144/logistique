@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
{{--    retourner vers la list des clients avec une icone retour en rouge avec mdi--}}
    <a href="{{ route('clients.index') }}" class="btn btn-sm btn-danger mb-2"><i class="mdi mdi-arrow-left"></i> Retour</a>
{{--button pour generer un facture pour ce client--}}
    <a href="{{ route('download', $clientId) }}" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-file-document"></i> Générer une facture</a>
    <!-- le formulaire pour ajouter la date de rembousement en utilisan un jolie card boostrap si la date remboursement exist met le ajour et la date par defaut sera la date de remboursement -->
{{--la condition si le restant n'est pas null--}}




    <!-- Contenu modal variable pour l'ajout d'un payement -->
    <div class="modal fade" id="addpayementModal" tabindex="-1" aria-labelledby="addpayementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addpayementModalLabel">Ajouter un nouveau payement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm" action="{{ route('payements.store') }}" method="POST">
                        @csrf
                        <!-- Champ caché pour client_id -->
                        <input type="hidden" name="client_id" value="{{ $clientId }}">

                        <div class="mb-3">
                            <label for="payement-montant" class="col-form-label">Montant:</label>
                            <input type="number" class="form-control" id="payement-montant" name="montant" required>
                        </div>
                        <button type="submit" class="text-center btn btn-primary">Enregistrer</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editerpayementModal" tabindex="-1" aria-labelledby="editerpayementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editerpayementModalLabel">Éditer un payement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editerClientForm" action="" method="POST">
                        @csrf
                        @method('PUT') <!-- Ajout de la directive pour simuler une requête PUT -->
                        <input type="hidden" name="id" id="payement-id">
                        <input type="hidden" name="client_id" value="{{ $clientId }}"><!-- Champ caché pour l'ID du payement -->
                        <div class="mb-3">
                            <label for="edit-payement-montant" class="col-form-label">Montant:</label>
                            <input type="number" class="form-control" id="edit-payement-montant" name="montant" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addarticleModal" tabindex="-1" aria-labelledby="addarticleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addarticleModalLabel">Ajouter un nouveau article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm" action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        <!-- Champ caché pour client_id -->
                        <input type="hidden" name="client_id" value="{{ $clientId }}">

                        <div class="mb-3">
                            <label for="article-nom" class="col-form-label">Nom:</label>
                            <input type="text" class="form-control" id="article-nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="article-montant" class="col-form-label">Montant:</label>
                            <input type="number" class="form-control" id="article-montant" name="montant" required>
                        </div>
                         <div class="mb-3">
                            <label for="article-quantite" class="col-form-label">Quantité:</label>
                            <input type="number" class="form-control" id="article-quantite" name="quantite" required>
                        </div>

                        <button type="submit" class="text-center btn btn-primary">Enregistrer</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editerarticleModal" tabindex="-1" aria-labelledby="editerarticleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editerarticleModalLabel">Éditer un article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editerClientForm" action="" method="POST">
                        @csrf
                        @method('PUT') <!-- Ajout de la directive pour simuler une requête PUT -->
                        <input type="hidden" name="id" id="article-id">
                        <input type="hidden" name="client_id" value="{{ $clientId }}"><!-- Champ caché pour l'ID du article -->
                        <div class="mb-3">
                            <label for="edit-article-nom" class="col-form-label">Nom:</label>
                            <input type="text" class="form-control" id="edit-article-nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-article-montant" class="col-form-label">Montant:</label>
                            <input type="number" class="form-control" id="edit-article-montant" name="montant" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-article-quantite" class="col-form-label">Quantité:</label>
                            <input type="text" class="form-control" id="edit-article-quantite" name="quantite" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Listes Article/Service</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addarticleModal" data-bs-whatever="@mdo">
                        <i class="uil uil-plus me-2"></i> Ajouter
                    </button>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>

                                <th scope="col">Nom</th>
                                <th scope="col">Montant</th>
                                <th scope="col">quantité</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{$article->nom}} </td>
                                <td>{{number_format($article->montant, 0, ',', ' ')}} CFA</td>
                                <td>{{$article->quantite}} </td>
                                <td>{{number_format($article->quantite * $article->montant, 0, ',', ' ')}} CFA </td>
                                <td>
                                    <!-- Bouton Éditer -->
                                    <!-- Bouton Éditer dans la boucle des articles -->

                                    <button class="btn btn-sm btn-primary edit-article-button" data-bs-toggle="modal" data-bs-target="#editerarticleModal"
                                       data-bs-id="{{ $article->id }}"
                                       data-montant="{{ $article->montant }}"
                                       data-nom="{{ $article->nom }}"
                                      >Éditer</button>


                                    <!-- Bouton Supprimer -->
                                    <!-- Notez que nous utilisons un formulaire pour la suppression pour inclure le CSRF token -->
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce article ?');">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot class="table-light">
                            <tr>
                                <td colspan="3">Total</td>
                                <td>
                                    @php
                                        $total = 0;
                                        foreach ($articles as $article) {
                                            $total += $article->montant * $article->quantite;
                                        }
                                        echo number_format($total, 0, ',', ' ');
                                    @endphp CFA
                                </td>
                            </tr>
                            </tfoot>

                        </table>

                        <!-- end table -->
                    </div>

                    <!-- end table responsive -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Payement effectuer</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpayementModal" data-bs-whatever="@mdo">
                        <i class="uil uil-plus me-2"></i> Ajouter
                    </button>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>

                                <th scope="col">Date</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payements as $payement)
                            <tr>
                                <td>{{ $payement->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{number_format($payement->montant, 0, ',', ' ') }} CFA</td>
                                </td>
                                <td>
                                    <!-- Bouton Éditer -->
                                    <!-- Bouton Éditer dans la boucle des payements -->

                                    <button class="btn btn-sm btn-primary edit-payement-button" data-bs-toggle="modal" data-bs-target="#editerpayementModal"
                                       data-bs-id="{{ $payement->id }}"
                                       data-montant="{{ $payement->montant }}"
                                      >Éditer</button>


                                    <!-- Bouton Supprimer -->
                                    <!-- Notez que nous utilisons un formulaire pour la suppression pour inclure le CSRF token -->
                                    <form action="{{ route('payements.destroy', $payement->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce payement ?');">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot class="table-light">
                            <tr>
                                <td colspan="1">Total</td>
                                <td>
                                    @php
                                        $total = 0;
                                        foreach ($payements as $payement) {
                                            $total += $payement->montant;
                                        }
                                        echo number_format($total, 0, ',', ' ');
                                    @endphp CFA
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                        <!-- end table -->
                    </div>

                    <!-- end table responsive -->
                </div><!-- end card-body -->
            </div><!-- end card -->
            @if($client->restant() != null)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title
            ">Date de remboursement des <span style="border-radius: 5px" class="bg-primary p-1 text-white">{{ number_format($client->restant(), 0, ',', ' ') }} CFA</span></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('remboursement', $clientId) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <input type="hidden" name="client_id" value="{{ $clientId }}">
                                <input type="date"  class="form-control" id="date-remboursement" name="date_remboursement" required value="{{ $client->date_remboursement ?? date('d-m-y') }}">

                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            @endif
        </div><!-- end col -->



    </div>


@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editerClientModal = document.getElementById('editerpayementModal');
            var editerArticleModal = document.getElementById('editerarticleModal');
            editerClientModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Bouton qui a déclenché le modal
                var payementId = button.getAttribute('data-bs-id');
                var montant = button.getAttribute('data-montant');
                var client_id = button.getAttribute('data-client_id');

                // Mise à jour de l'action du formulaire avec l'ID du payement
                var form = this.querySelector('form');
                var actionURL = '/payements/' + payementId; // Assurez-vous que cette URL correspond à votre route de mise à jour
                form.action = actionURL;

                // Pré-remplir les champs du formulaire
                this.querySelector('#edit-payement-montant').value = montant;
                this.querySelector('#edit-payement-client_id').value = client_id;

                // Si vous avez un champ caché pour l'ID, mettez-le à jour également
                this.querySelector('form input[name="id"]').value = payementId;
            });
            editerArticleModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Bouton qui a déclenché le modal
                var articleId = button.getAttribute('data-bs-id');
                var nom = button.getAttribute('data-nom');
                var montant = button.getAttribute('data-montant');
                var client_id = button.getAttribute('data-client_id');

                // Mise à jour de l'action du formulaire avec l'ID du article
                var form = this.querySelector('form');
                var actionURL = '/articles/' + articleId; // Assurez-vous que cette URL correspond à votre route de mise à jour
                form.action = actionURL;

                // Pré-remplir les champs du formulaire
                this.querySelector('#edit-article-nom').value = nom;
                this.querySelector('#edit-article-montant').value = montant;
                this.querySelector('#edit-article-client_id').value = client_id;

                // Si vous avez un champ caché pour l'ID, mettez-le à jour également
                this.querySelector('form input[name="id"]').value = articleId;
            });

        });
    </script>

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
