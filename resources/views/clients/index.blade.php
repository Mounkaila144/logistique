@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')

    <!-- Varying modal content -->
    <!-- Contenu modal variable pour l'ajout d'un client -->
    <div class="modal fade" id="addclientModal" tabindex="-1" aria-labelledby="addclientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addclientModalLabel">Ajouter un nouveau client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm" action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="client-name" class="col-form-label">Nom:</label>
                            <input type="text" class="form-control" id="client-name" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="client-firstname" class="col-form-label">Prénom:</label>
                            <input type="text" class="form-control" id="client-firstname" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="client-phone" class="col-form-label">Téléphone:</label>
                            <input type="tel" class="form-control" id="client-phone" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="client-address" class="col-form-label">Adresse:</label>
                            <input type="text" class="form-control" id="client-address" name="adresse" required>
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
    <div class="modal fade" id="editerclientModal" tabindex="-1" aria-labelledby="editerclientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editerclientModalLabel">Éditer un client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editerClientForm" action="" method="POST">
                        @csrf
                        @method('PUT') <!-- Ajout de la directive pour simuler une requête PUT -->
                        <input type="hidden" name="id" id="client-id"> <!-- Champ caché pour l'ID du client -->
                        <div class="mb-3">
                            <label for="edit-client-name" class="col-form-label">Nom:</label>
                            <input type="text" class="form-control" id="edit-client-name" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-client-firstname" class="col-form-label">Prénom:</label>
                            <input type="text" class="form-control" id="edit-client-firstname" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-client-phone" class="col-form-label">Téléphone:</label>
                            <input type="tel" class="form-control" id="edit-client-phone" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-client-address" class="col-form-label">Adresse:</label>
                            <input type="text" class="form-control" id="edit-client-address" name="adresse" required>
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

<style>
    @media (min-width: 992px) { /* Correspond à 'lg' dans Bootstrap */
        .text-lg-nowrap {
            white-space: nowrap;
        }
    }

</style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title mb-0 flex-grow-1">Listes</h4>


                    <!-- Default Modals -->
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Filtre</button>
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('clients.index') }}" method="GET" class=" align-items-center">
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



                    <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#addclientModal">
                        <i class="uil uil-plus me-2"></i> Ajouter
                    </button>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-striped">
                            <thead class="table-light">
                            <tr>

                                <th scope="col"># ID</th>
                                <th scope="col">Date de Rembousement</th>
                                <th scope="col">Client</th>
                                <th scope="col">telephone</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $client)
                                <tr class="{{ $client->estRembourse() ? 'table-info' : ($client->remboursementDepasse()? 'table-danger':'table-warning') }}">

                                <td><a href="#" class="fw-semibold">#{{$client->id}}</a></td>
                                    <td>
                                        {{ $client->estRembourse() ? 'Tout est payé' : ($client->date_remboursement ? \Carbon\Carbon::parse($client->date_remboursement)->isoFormat('dddd D/M/YYYY') : 'Aucune date') }}
                                    </td>




                                    <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="build/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            {{ $client->prenom }} {{ $client->nom }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{$client->telephone}}</td>
                                <td>{{$client->adresse}}</td>
                                <td>
                                    <!-- Bouton Éditer -->
                                    <!-- Bouton Éditer dans la boucle des clients -->
                                    <a href="{{ route('payements.index', ['client_id' => $client->id]) }}" class="btn btn-sm btn-success">Paiements</a>

                                    <button class="btn btn-sm btn-info edit-client-button" data-bs-toggle="modal" data-bs-target="#editerclientModal"
                                       data-bs-id="{{ $client->id }}"
                                       data-nom="{{ $client->nom }}"
                                       data-prenom="{{ $client->prenom }}"
                                       data-telephone="{{ $client->telephone }}"
                                            data-adresse="{{ $client->adresse }}">Éditer</button>


                                    <!-- Bouton Supprimer -->
                                    <!-- Notez que nous utilisons un formulaire pour la suppression pour inclure le CSRF token -->
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>

                        <!-- end table -->
                    </div>
                        {!! $clients->links('pagination::bootstrap-5') !!}
                    <!-- end table responsive -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>


@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editerClientModal = document.getElementById('editerclientModal');
            editerClientModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Bouton qui a déclenché le modal
                var clientId = button.getAttribute('data-bs-id');
                var nom = button.getAttribute('data-nom');
                var prenom = button.getAttribute('data-prenom');
                var telephone = button.getAttribute('data-telephone');
                var adresse = button.getAttribute('data-adresse');

                // Mise à jour de l'action du formulaire avec l'ID du client
                var form = this.querySelector('form');
                var actionURL = '/clients/' + clientId; // Assurez-vous que cette URL correspond à votre route de mise à jour
                form.action = actionURL;

                // Pré-remplir les champs du formulaire
                this.querySelector('#edit-client-name').value = nom;
                this.querySelector('#edit-client-firstname').value = prenom;
                this.querySelector('#edit-client-phone').value = telephone;
                this.querySelector('#edit-client-address').value = adresse;

                // Si vous avez un champ caché pour l'ID, mettez-le à jour également
                this.querySelector('form input[name="id"]').value = clientId;
            });
        });
    </script>

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
