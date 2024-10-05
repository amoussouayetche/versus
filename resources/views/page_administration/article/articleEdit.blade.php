<!-- debut Modal modifier -->
<div class="modal fade" id="modifier{{ $article->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">EDITER L'ARTICLE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('articles.update', $article->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libelle: </label>
                        <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $article->libelle }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé: </label>
                        <input type="text" class="form-control" id="resume" name="resume" value="{{ $article->resume }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="lien" class="form-label">Lien: </label>
                        <input type="text" class="form-control" id="lien" name="lien" value="{{ $article->lien }}"
                            required>
                    </div>
                  
                    <div class="mb-3">
                        <label for="image" class="form-label">Image: </label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $article->image }}">
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin modal modifier -->