<!-- debut Modal voir -->
<div class="modal fade div_voir_modal" id="voir{{ $personnel->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">INFORMATION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('personnels.show', $personnel->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <img src="/../../images/{{ $personnel->image }}" width="300" height="300"
                            class="rounded-3 mx-auto d-block" alt="image du personnel">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="nom_utilisateur" class="form-label">Identifiant: </label>
                        <span>{{ $personnel->id }}</span>
                    </div> --}}
                    <div class="mb-3">
                        <label for="nom_utilisateur" class="form-label">Nom: </label>
                        <span>{{ $personnel->name }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="mot_passe" class="form-label">Email: </label>
                        <span>{{ $personnel->email }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Spécialité: </label>
                        <span>{{ $personnel->specialite }}</span>
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
