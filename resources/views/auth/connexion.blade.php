@extends('index')

@section('content')

<div style="margin-top: 0; 
    margin-bottom: 0;
    flex: 1;
    padding: 20px;
    background-color: white;" class="container center-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="{{ route('connexion') }}" method="POST">
                @csrf
                <div class="d-flex align-items-center justify-content-center">

                    <img src="{{ asset(env('ASSET_PATH', '').'images/VENUS.PNG')}}" width="200" height="150" alt="image de venus">
                </div>
                <h1 class="text-center my-4">Connectez-vous à votre compte</h1>
                <!-- Champ Pseudo -->
                <div class="group-input input-group d-flex flex-row mb-3">
                    <span class="icon-radius input-group-text bg-light shadow">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" class="input-radius form-control shadow @error('pseudo') is-invalid @enderror" id="pseudo"
                        placeholder="Pseudo" name="pseudo" value="{{ old('pseudo') }}" >
                    @error('pseudo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Champ Mot de Passe -->
                <div class="group-input input-group d-flex flex-row mb-3">
                    <span class="icon-radius input-group-text bg-light shadow">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" class="input-radius form-control shadow @error('password') is-invalid @enderror" id="password"
                        placeholder="Mot de passe" name="password" >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton Se connecter -->
                <div>
                    <button type="submit" class="btn text-light fw-bold w-100 rounded-pill py-3" style="background-color: #530c78de;">Se connecter</button>
                </div>

                <!-- Lien Mot de passe oublié -->
                <div class="text-center my-3">
                    <a href="#" class="text-decoration-none">Mot de passe oublié?</a>
                </div>

                <!-- Lien S'inscrire -->
                <div class="text-center m-3">
                    Vous n'avez pas de compte ? 
                    <a href="{{ url('page-inscription') }}" class="text-decoration-none">
                        <strong class="text-primary">S'inscrire</strong>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
