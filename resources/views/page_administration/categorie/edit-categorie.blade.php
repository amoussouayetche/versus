
<div class="modal fade" id="modifier{{ $categorie->id }}" tabindex="-1" aria-labelledby="modifierLabel{{ $categorie->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifierLabel{{ $categorie->id }}">MODIFIER LA CATEGORIE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('modifier', ['id' => $categorie->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" id="libelle" name="libelle" value="{{ old('libelle', $categorie->libelle) }}" required>
                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
