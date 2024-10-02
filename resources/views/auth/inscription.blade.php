@extends('index')
@section('content')
    @include('partials.header')
    <div style="margin-top: 70px" class="container d-flex flex-col align-items-center justify-content-center">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form action="{{ route('inscription') }}" method="POST">
                    @csrf
                    <!-- Champ Pseudo -->
                    <div class="group-input input-group d-flex flex-row mb-3">
                        <span class="icon-radius input-group-text bg-light shadow"><i class="fa fa-user"></i></span>
                        <input type="text" class="input-radius form-control shadow @error('pseudo') is-invalid @enderror"
                            id="pseudo" placeholder="Pseudo" name="pseudo" value="{{ old('pseudo') }}">
                        @error('pseudo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Téléphone -->
                    <div class="group-input input-group d-flex flex-row mb-3">
                        <span class="icon-radius input-group-text bg-light shadow"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="input-radius form-control shadow @error('tel') is-invalid @enderror"
                            id="tel" placeholder="Numéro de téléphone" name="tel" value="{{ old('tel') }}">
                        @error('tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Genre -->
                    <div class="group-input input-group d-flex flex-row mb-3">
                        <span class="icon-radius input-group-text bg-light shadow"><i
                                class="fa-solid fa-venus-mars"></i></span>
                        <select class="input-radius form-control shadow @error('genre') is-invalid @enderror" id="genre"
                            name="genre">
                            <option value="">Genre</option>
                            <option value="Homme" {{ old('genre') == 'Homme' ? 'selected' : '' }}>Masculin</option>
                            <option value="Femme" {{ old('genre') == 'Femme' ? 'selected' : '' }}>Féminin</option>
                        </select>
                        @error('genre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Date de Naissance -->
                    <div class="group-input input-group d-flex flex-row mb-1">
                        <!-- Icône de calendrier -->
                        <span class="icon-radius input-group-text bg-light shadow">
                            <i class="fa-solid fa-calendar-days"></i>
                        </span>
                        <!-- Champ de saisie de date avec placeholder -->
                        <input type="date"
                            class="input-radius form-control shadow @error('naissance') is-invalid @enderror" 
                            id="naissance"
                            name="naissance" 
                            placeholder="Sélectionnez une date de naissance"
                            value="{{ old('naissance') }}">
                                            @error('naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <span style="font-size: 13px; color: #888;">L'âge doit être d'au moins 9 mois.</span>
                    
                    <!-- Champ Mot de Passe -->
                    <div class="group-input input-group d-flex flex-row mb-1">
                        <span class="icon-radius input-group-text bg-light shadow"><i class="fa-solid fa-lock"></i></span>
                        <input type="password"
                            class="input-radius form-control shadow @error('password') is-invalid @enderror" id="password"
                            placeholder="Mot de passe" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <span style="font-size: 13px; color: #888;">Le mot de passe doit être d'au moins 8 caractères.</span>

                    <!-- Champ Confirmation Mot de Passe -->
                    <div class="group-input input-group d-flex flex-row mb-1">
                        <span class="icon-radius input-group-text bg-light shadow"><i class="fa-solid fa-lock"></i></span>
                        <input type="password"
                            class="input-radius form-control shadow @error('password_confirmation') is-invalid @enderror"
                            id="passwordConfirm" placeholder="Confirmez le mot de passe" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Condition d'utilisation (Checkbox) -->
                    <div class="form-check">
                        <input type="hidden" id="condition" name="condition" value="0">
                        @error('condition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <div>
                        <button type="submit" class="btn text-light fw-bold w-100 rounded-pill py-3"
                            style="background-color: #530c78de;">Suivant</button>
                    </div>

                    <!-- Lien vers Connexion -->
                    <div class="text-center m-3">
                        Vous avez déjà un compte ? <a href="{{ url('page-connexion') }}"
                            class="text-decoration-none"><strong class="text-primary">Se connecter</strong></a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
