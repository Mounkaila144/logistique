@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
{{--    retourner vers la list des camions avec une icone retour en rouge avec mdi--}}
    <a href="{{ route('camions.index') }}" class="btn btn-sm btn-danger mb-2"><i class="mdi mdi-arrow-left"></i> Retour</a>
{{--button pour generer un facture pour ce camion--}}
    <!-- le formulaire pour ajouter la date de rembousement en utilisan un jolie card boostrap si la date remboursement exist met le ajour et la date par defaut sera la date de remboursement -->
{{--la condition si le restant n'est pas null--}}




    <!-- Contenu modal variable pour l'ajout d'un donne -->
    <div class="modal fade" id="adddonneModal" tabindex="-1" aria-labelledby="adddonneModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adddonneModalLabel">Ajouter un nouveau donne</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm" action="{{ route('donnes.store') }}" method="POST">
                        @csrf
                        <!-- Champ caché pour camion_id -->
                        <input type="hidden" name="camion_id" value="{{ $camionId }}">

                        <div class="mb-3">
                            <label for="donne-montant" class="col-form-label">Montant:</label>
                            <input type="number" class="form-control" id="donne-montant" name="montant" required>
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
    <div class="modal fade" id="editerdonneModal" tabindex="-1" aria-labelledby="editerdonneModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editerdonneModalLabel">Éditer un donne</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editerClientForm" action="" method="POST">
                        @csrf
                        @method('PUT') <!-- Ajout de la directive pour simuler une requête PUT -->
                        <input type="hidden" name="id" id="donne-id">
                        <input type="hidden" name="camion_id" value="{{ $camionId }}"><!-- Champ caché pour l'ID du donne -->
                        <div class="mb-3">
                            <label for="edit-donne-montant" class="col-form-label">Montant:</label>
                            <input type="number" class="form-control" id="edit-donne-montant" name="montant" required>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Payement effectuer</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adddonneModal" data-bs-whatever="@mdo">
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
                            @foreach ($donnes as $donne)
                            <tr>
                                <td>{{ $donne->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{number_format($donne->montant, 0, ',', ' ') }} CFA</td>
                                </td>
                                <td>
                                    <!-- Bouton Éditer -->
                                    <!-- Bouton Éditer dans la boucle des donnes -->

                                    <button class="btn btn-sm btn-primary edit-donne-button" data-bs-toggle="modal" data-bs-target="#editerdonneModal"
                                       data-bs-id="{{ $donne->id }}"
                                       data-montant="{{ $donne->montant }}"
                                      >Éditer</button>


                                    <!-- Bouton Supprimer -->
                                    <!-- Notez que nous utilisons un formulaire pour la suppression pour inclure le CSRF token -->
                                    <form action="{{ route('donnes.destroy', $donne->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="camion_id" value="{{ $camionId }}">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce donne ?');">Supprimer</button>
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
                                        foreach ($donnes as $donne) {
                                            $total += $donne->montant;
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
            @if($camion->restant() != null)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title
            ">Date de remboursement des <span style="border-radius: 5px" class="bg-primary p-1 text-white">{{ number_format($camion->restant(), 0, ',', ' ') }} CFA</span></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('remboursement-camion', $camionId) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <input type="hidden" name="camion_id" value="{{ $camionId }}">
                                <input type="date"  class="form-control" id="date-remboursement" name="date_remboursement" required value="{{ $camion->date_remboursement ?? date('d-m-y') }}">

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
            var editerClientModal = document.getElementById('editerdonneModal');
            editerClientModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Bouton qui a déclenché le modal
                var donneId = button.getAttribute('data-bs-id');
                var montant = button.getAttribute('data-montant');
                var camion_id = button.getAttribute('data-camion_id');

                // Mise à jour de l'action du formulaire avec l'ID du donne
                var form = this.querySelector('form');
                var actionURL = '/donnes/' + donneId; // Assurez-vous que cette URL correspond à votre route de mise à jour
                form.action = actionURL;

                // Pré-remplir les champs du formulaire
                this.querySelector('#edit-donne-montant').value = montant;
                this.querySelector('#edit-donne-camion_id').value = camion_id;

                // Si vous avez un champ caché pour l'ID, mettez-le à jour également
                this.querySelector('form input[name="id"]').value = donneId;
            });

        });
    </script>

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
