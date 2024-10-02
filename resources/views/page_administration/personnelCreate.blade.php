<!-- debut Modal ajouter -->

<div class="modal fade" id="ajouter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">AJOUTER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('personnels.store') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom: </label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                     <div class="mb-3">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe: </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="specialite" class="form-label">Spécialité: </label>
                        <input type="specialite" class="form-control" id="specialite" name="specialite" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="contact" class="form-label">Contact: </label>
                        <input type="tel" class="form-control" id="contact" name="contact" required>
                    </div> --}}
                 
                    <div class="mb-3">
                        <label for="image" class="form-label">image: </label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin modal ajouter -->
