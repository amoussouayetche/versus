<!-- debut Modal voir -->
<div class="modal fade div_voir_modal" id="voir{{ $article->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">INFORMATION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('articles.show', $article->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <img src="{{ asset(env('ASSET_PATH', '').'images/'. $article->image) }}" width="300" height="300"
                            class="rounded-3 mx-auto d-block" alt="image du article">
                    </div>
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libelle: </label>
                        <span>{{ $article->libelle }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé: </label>
                        <span>{{ $article->resume }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="lien" class="form-label">Lien: </label>
                        <span>{{ $article->lien }}</span>
                    </div>
                  
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <!-- <button type="submit" class="btn btn-primary">Ajouter</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin modal voir -->
