@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Basic Tables @endslot
    @endcomponent
    <!-- Varying modal content -->
    <!-- Contenu modal variable pour l'ajout d'un camion -->
    <div class="modal fade" id="addcamionModal" tabindex="-1" aria-labelledby="addcamionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addcamionModalLabel">Ajouter un nouveau camion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCamionForm" action="{{ route('camions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="camion-name" class="col-form-label">Matricule:</label>
                            <input type="text" class="form-control" id="camion-name" name="matricule" required>
                        </div>
                        <div class="mb-3">
                            <label for="camion-montant" class="col-form-label">Montant total à payer:</label>

                            <input type="text" class="form-control" id="camion-montant" name="montant" required>
                        </div>
          <div class="mb-3">
                            <label for="camion-detail" class="col-form-label">Detail:</label>

                            <input type="text" class="form-control" id="camion-detail" name="detail" required>
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
    <div class="modal fade" id="editercamionModal" tabindex="-1" aria-labelledby="editercamionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editercamionModalLabel">Éditer un camion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editerCamionForm" action="" method="POST">
                        @csrf
                        @method('PUT') <!-- Ajout de la directive pour simuler une requête PUT -->
                        <input type="hidden" name="id" id="camion-id"> <!-- Champ caché pour l'ID du camion -->
                        <div class="mb-3">
                            <label for="edit-camion-name" class="col-form-label">Matricule:</label>
                            <input type="text" class="form-control" id="edit-camion-matricule" name="matricule" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-camion-montant" class="col-form-label">Montant total à payer:</label>

                            <input type="text" class="form-control" id="edit-camion-montant" name="montant" required>
                        </div>
                         <div class="mb-3">
                            <label for="edit-camion-detail" class="col-form-label">Detail:</label>

                            <input type="text" class="form-control" id="edit-camion-detail" name="detail" required>
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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Listes</h4>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Filtre</button>
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Filtre</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('camions.index') }}" method="GET" class=" align-items-center">
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="checkbox" name="remboursementDepasse" id="remboursementDepasse" {{ request('remboursementDepasse') ? 'checked' : '' }}>
                                            <label class="form-check-label text-lg-nowrap" for="remboursementDepasse">
                                                Date de remboursement dépassée
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Rechercher par nom, téléphone..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary">Rechercher</button>
                                        </div>

                                    </form> </div>


                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#addcamionModal" data-bs-whatever="@mdo">
                        <i class="uil uil-plus me-2"></i> Ajouter
                    </button>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>

                                <th scope="col"># ID</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Date de Rembousement</th>

                                <th scope="col">Montant total à payer</th>
                                <th scope="col">Details</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($camions as $camion)
                                <tr class="{{ $camion->estRembourse() ? 'table-info' : ($camion->remboursementDepasse()? 'table-danger':'table-warning') }}">
                                <td><a href="#" class="fw-semibold">#{{$camion->id}}</a></td>

                                <td>{{$camion->matricule}}</td>
                                <td>
                                    {{ $camion->estRembourse() ? 'Tout est payé' : ($camion->date_remboursement ? \Carbon\Carbon::parse($camion->date_remboursement)->isoFormat('dddd D/M/YYYY') : 'Aucune date') }}
                                </td>
                                <td>{{$camion->montant}}</td>
                                <td>{{$camion->detail}}</td>
                                <td>
                                    <!-- Bouton Éditer -->
                                    <!-- Bouton Éditer dans la boucle des camions -->
                                    <a href="{{ route('donnes.index', ['camion_id' => $camion->id]) }}" class="btn btn-sm btn-success">Paiements</a>

                                    <button class="btn btn-sm btn-info edit-camion-button" data-bs-toggle="modal" data-bs-target="#editercamionModal"
                                       data-bs-id="{{ $camion->id }}"
                                       data-matricule="{{ $camion->matricule }}"
                                       data-montant="{{ $camion->montant }}"
                                       data-detail="{{ $camion->detail }}"
                                       >Éditer</button>


                                    <!-- Bouton Supprimer -->
                                    <!-- Notez que nous utilisons un formulaire pour la suppression pour inclure le CSRF token -->
                                    <form action="{{ route('camions.destroy', $camion->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce camion ?');">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>

                        <!-- end table -->
                    </div>
                        {!! $camions->links('pagination::bootstrap-5') !!}
                    <!-- end table responsive -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>


@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editerCamionModal = document.getElementById('editercamionModal');
            editerCamionModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Bouton qui a déclenché le modal
                var camionId = button.getAttribute('data-bs-id');
                var matricule = button.getAttribute('data-matricule');
                var montant = button.getAttribute('data-montant');
                var detail = button.getAttribute('data-detail');

                // Mise à jour de l'action du formulaire avec l'ID du camion
                var form = this.querySelector('form');
                var actionURL = '/camions/' + camionId; // Assurez-vous que cette URL correspond à votre route de mise à jour
                form.action = actionURL;

                // Pré-remplir les champs du formulaire
                this.querySelector('#edit-camion-matricule').value = matricule;
                this.querySelector('#edit-camion-montant').value = montant;
                this.querySelector('#edit-camion-detail').value = detail;

                // Si vous avez un champ caché pour l'ID, mettez-le à jour également
                this.querySelector('form input[name="id"]').value = camionId;
            });
        });
    </script>

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
