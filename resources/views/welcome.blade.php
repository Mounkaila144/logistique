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
                        <input type="number" class="form-control" id="article-nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="article-montant" class="col-form-label">Montant:</label>
                        <input type="number" class="form-control" id="article-montant" name="montant" required>
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
                        <input type="number" class="form-control" id="edit-article-nom" name="nom" required>
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
