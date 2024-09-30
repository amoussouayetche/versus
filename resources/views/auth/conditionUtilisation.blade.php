@extends('index')
@section('content')
    @include('partials.header')
    <div style="margin-top: 100px;" class="container d-flex flex-col align-items-center justify-content-center">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form action="{{ route('condition', $client->id) }}" method="POST">
                    @csrf
                    
                    <div class="text-center m-3">
                        <h3>Condition d'utilisation et Politique de protection des données personnels.</h3>
                        <p class="fs-5">Pour créer un compte, veuillez accepter les <a href="#">Condition d"utilisation</a></p>
                    </div>

                    <div class="form-check border border-2 p-4 d-flex justify-content-around rounded-3">
                        <input style="padding: 11px" class="form-check-input mx-1" type="checkbox" id="gridCheck" name="condition">
                        <label class="form-check-label fs-5 mx-1" for="gridCheck">
                            j'ai lu et accepté les conditions d'utilisation
                        </label>
                    </div>
                    <div class="text-center m-3">
                        <p class="fs-5">Vous trouverez plus d'informations sur les traitements des données personnelles en <a href="#">cliquant ici</a></p>
                    </div>
                    <div>
                        <button type="submit" class="btn text-light fw-bold w-100 rounded-pill py-3" style="background-color: #530c78de;">Suivant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
