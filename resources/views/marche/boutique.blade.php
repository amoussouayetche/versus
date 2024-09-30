@include('partials.head')
@include('partials.header')

<div style="margin-top: 60px; margin-bottom: 100px" class="container">
    <!-- Champ de recherche -->
    <div class="row">
        <div class="col-sm-12">
            <div class="group-input input-group d-flex flex-row mb-3">
                <span style="padding: -10px;" class="icon-radius input-group-text bg-light shadow"><i
                        class="fa-solid fa-search"></i></span>
                <input type="search" class="input-radius form-control shadow @error('recherche') is-invalid @enderror"
                    id="recherche" placeholder="Que recherchez-vous ?" name="recherche">
                <a href="#" style="height: 60%;" class="icon-radius input-group-text shadow">
                    <i style="padding: 10px;" class="fa-solid fa-sliders bg-primary text-light rounded-3"></i>
                </a>
                @error('recherche')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- panier -->
    <div class="row">
        <div class="col-sm-12">
            <div>
                <a type="button" href="{{ url('mon-panier') }}" class="btn text-light fw-bold w-100 rounded-3 py-3"
                    style="background-color: #530c78de;">Mon panier <i class="fa-solid fa-cart-shopping"></i>
                    <sup>{{ count((array) session('cart')) }}</sup></a>
            </div>
        </div>
    </div>

    {{-- catégorie --}}
    <div class="row my-4">
        <div class="col-sm-12 d-flex flex-row justify-content-between align-items-center m-2">
            <h3 class="fw-bold">Catégorie</h3>
            <a href="#" class="text-uppercase text-decoration-none fw-bold">Tout voir <i
                    class="fa-solid fa-angle-right"></i> </a>
        </div>
        {{-- liste --}}
        <div class="col-sm-12 m-2">
            <div style="padding: 10px 0; background-color: #f9f9f9;" class="overflow-auto text-nowrap">
                <ul style="list-style: none;" class="category-list d-flex gap-4 p-0 m-0">
                    @foreach ($categories as $categorie)
                        <li class="{{ Request::is( $categorie->libelle ) ? 'active' : '' }}">
                            <a href="#" class="fw-bold text-secondary text-decoration-none">{{ $categorie->libelle }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- les produis --}}
    <div class="row my-4">
        @foreach ($produits as $produit)
        <div class="col-md-3 col-sm-3 mb-4">
                <div class="card">
                    <div  class="wishlist-icon">
                        <a href="{{ route('ajouter-produit', $produit->id) }}">
                            <i style="font-size: 30px" class="fa-solid fa-cart-plus"></i></a>
                    </div>
                    <img src="{{ $produit->image }}" alt="image du poduit">
                    <div class="card-body">
                        <h5 class="product-title text-truncate">{{ $produit->libelle }} -
                            {{ \Illuminate\Support\Str::words($produit->description, 10, '...') }}</h5>
                        <p class="product-price">{{ $produit->prix }} fcfa</p>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>

@include('partials.nav')
@include('partials.footer')
