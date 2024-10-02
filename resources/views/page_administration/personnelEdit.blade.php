<!-- debut Modal modifier -->
<div class="modal fade" id="modifier{{ $personnel->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">EDITER LE PERSONNEL</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('personnels.update', $personnel->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom: </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $personnel->name }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $personnel->email }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="specialite" class="form-label">Spécialité: </label>
                        <input type="text" class="form-control" id="specialite" name="specialite" value="{{ $personnel->specialite }}"
                            required>
                    </div>
                    {{-- <!-- <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe: </label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="{{ $personnel->password }}" required>
                    </div> --> --}}
                    {{-- <div class="mb-3">
                        <label for="contact" class="form-label">Contact: </label>
                        <input type="tel" class="form-control" id="contact" name="contact"
                            value="{{ $personnel->contact }}" required>
                    </div> --}}
                  
                    <div class="mb-3">
                        <label for="image" class="form-label">Image: </label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $personnel->image }}">
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