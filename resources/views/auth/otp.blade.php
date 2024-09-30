@extends('index')
@section('content')
    @include('partials.header')
    <div style="margin-top: 100px" class="container d-flex flex-col align-items-center justify-content-center">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <form action="" method="POST">
                    @csrf

                    <div>
                        <img style="width: 40%; margin: 40px" src="images/otp.png" class="rounded-cirle mx-auto d-block" alt="image de déco">
                    </div>

                    <h1 class="text-center fw-bold">Saisissez le code que nous vous avons envoyé par SMS</h1>

                    <!-- Champ Téléphone -->
                    <div class="group-input input-group d-flex flex-row mb-3">
                        <span class="icon-radius input-group-text bg-light shadow"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="input-radius form-control shadow @error('tel') is-invalid @enderror"
                            id="tel" placeholder="Numéro de téléphone" name="tel" value="{{ old('tel') }}">
                        @error('tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lien pour sms non reçu -->
                    <div style="margin-bottom: 15px" class="tm-3">
                        <p class="fs-5">Nous vous avons envoyé un SMS au numéro</p>
                        <a href="{{ url('page-connexion') }}" class="fs-5 text-decoration-none">Vous n'avez pas reçu de SMS</a>
                    </div>

                    <!-- Bouton de soumission -->
                    <div>
                        <button type="submit" class="btn text-light fs-5 fw-bold w-100 rounded-pill py-3 my-2"
                            style="background-color: #530c78de;">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
