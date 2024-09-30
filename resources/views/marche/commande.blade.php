@include('partials.head')
@include('partials.header')

<div class="container">
    <!-- Champ de recherche -->
    <div class="row" style="margin-top: 80px;">
        <div class="d-flex justify-content-between">
            <a href=""
                class="btn btn-outline-primary w-100 rounded-pill me-2 d-flex align-items-center justify-content-center  py-3 my-4">
                En cours
            </a>
            <a href="" class="btn btn-outline-secondary w-100 rounded-pill d-flex align-items-center justify-content-center py-3 my-4">
                Livrées
            </a>
        </div>
    </div>

    {{-- liste des personne de discution --}}
    <div style="margin-bottom: 100px" class="row">
        {{-- @foreach ($admins as $admin) --}}
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <img src="https://img.freepik.com/free-photo/red-white-pills_23-2147983100.jpg?t=st=1727546625~exp=1727550225~hmac=abb3e9570c9e8f7cf7f1a11fbfe863d36a3cdf0b3e81734c6c4f65dda404aa18&w=1060" class="rounded-3" style="width: 100px; height: 100px;"
                                    alt="">
                                <div class="ms-3">
                                    {{-- <label style="background-color: rgb(182, 212, 255)" class="m-0 w-100 border border-2 rounded-pill">{{ $admin->specialite }} professionnel</label> --}}
                                    <h5 class="card-title mb-1 fw-bold">Dimeblè</h5>
                                    <p class="text-muted mb-1">quantié: 2</p>
                                    <p style="color: blueviolet" class="fw-bold">7000 fcfa</p> 
                                    {{-- <span class="badge badge-success">Payés</span> --}}
                                </div>
                            </div>
                           
                        </div>

                        <div class="d-flex justify-content-between">
                            <a style="background-color: rgb(206, 228, 248)" href=""
                                class="btn btn-outline-secondary w-100 rounded-pill me-2 d-flex align-items-center justify-content-center">
                                 Détails
                            </a>
                            <a style="background-color: rgb(206, 228, 248)" href="" class="btn btn-outline-secondary w-100 rounded-pill d-flex align-items-center justify-content-center">
                                Trajet
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
</div>

@include('partials.nav')
@include('partials.footer')
