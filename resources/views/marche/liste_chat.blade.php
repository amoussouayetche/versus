@include('partials.head')
@include('partials.header')

<div class="container">
    <!-- Champ de recherche -->
    <div class="row" style="margin-top: 60px;">
        <div class="col-sm-12">
            <div class="group-input input-group d-flex flex-row mb-3">
                <input type="search" class="input-radius form-control shadow @error('recherche') is-invalid @enderror"
                    id="recherche" placeholder="Recherchez" name="recherche">
                <a href="#" style="height: 60%;" class="icon-radius input-group-text text-decoration-none shadow">
                    <i style="padding: 10px;" class="fa-solid fa-search bg-primary text-light rounded-3"></i>
                </a>
                @error('recherche')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    {{-- liste des personne de discution --}}
    @if (Auth::guard('client')->check())
    <div style="margin-bottom: 100px" class="row">

        @foreach ($admins as $admin)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <img src="images/homme.png" class="rounded-3" style="width: 60px; height: 60px;"
                                    alt="{{ $admin->name }}">
                                <div class="ms-3">
                                    {{-- <label style="background-color: rgb(182, 212, 255)" class="m-0 w-100 border border-2 rounded-pill">{{ $admin->specialite }} professionnel</label> --}}
                                    <h5 class="card-title mb-1 fw-bold">{{ $admin->name }}</h5>
                                    <p class="text-muted mb-1">{{ $admin->specialite ?? 'Cardiologue' }}</p>
                                    <p class="text-muted"><i class="fa fa-clock"></i> 09H - 17H</p>
                                </div>
                            </div>
                            <div>
                                <i style="font-size: 25px; top: 18px; right: 20px;" class="far fa-heart d-flex position-absolute"></i> <!-- Icône coeur -->
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('chat.withAdmin', $admin->id) }}"
                                class="btn btn-outline-primary w-100 me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-comments"></i> Discuter
                            </a>
                            <a href="{{ route('chat.withAdmin', $admin->id) }}" class="btn btn-primary w-100">
                                Prendre rendez-vous
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @elseif (Auth::guard('admin')->check())
    <div style="margin-bottom: 100px" class="row">
        @foreach ($clients as $client)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <img src="images/homme.png" class="rounded-3" style="width: 60px; height: 60px;"
                                    alt="{{ $client->pseudo }}">
                                <div class="ms-3">
                                    {{-- <label style="background-color: rgb(182, 212, 255)" class="m-0 w-100 border border-2 rounded-pill">{{ $admin->specialite }} professionnel</label> --}}
                                    <h5 class="card-title mb-1 fw-bold">{{ $client->pseudo }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a style="color: blueviolet; border: 1px solid blueviolet;" href="{{ route('chat.withClient', $client->id) }}"
                                class="fw-bold btn btn-outline-primary w-100 me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-comments"></i> Discuter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

@include('partials.nav')
@include('partials.footer')
