@include('partials.head')

<!-- Preloader -->
<div id="preloader">
    <img src="{{ asset(env('ASSET_PATH', '').'images/VENUS-SANS-FOND.PNG') }}" alt="Chargement..." />
</div>

<div id="main-content" style="display: none;">

    <style>
        /* Préloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            /* Fond blanc */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #preloader img {
            width: 100px;
            /* Taille de l'image */
        }

        /* Masquer le contenu principal pendant le chargement */
        #main-content {
            display: none;
        }

        .header-a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            /* Ajout d'un padding pour plus d'espace */
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .search-bar {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar input {
            border-radius: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
            max-width: 300px;
            /* Limiter la largeur pour les petits écrans */
        }

        .search-bar button {
            background-color: #f0f0f0;
            border: none;
            border-radius: 20px;
            padding: 10px;
        }

        .article {
            background-color: #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            height: 300px;
            /* Hauteur fixe pour maintenir le layout */
        }

        .products {
            margin-bottom: 20px;
        }

        .product-card {
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
            /* Équilibrage des marges */
            max-width: 200px;
            /* Limiter la largeur des cartes de produits */
            flex-shrink: 0;
            /* Empêcher le rétrécissement sur mobile */
        }

        .chat-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }

        .doctor-card {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .doctor-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .doctor-card {
            transition: transform 0.2s ease-in-out;
        }

        .doctor-card:hover {
            transform: scale(1.05);
            /* Effet de zoom au survol */
        }

        .specialty-badge {
            font-size: 0.85rem;
            font-weight: 600;
        }


        @media (max-width: 576px) {
            .header-a {
                flex-direction: column;
                /* Changer la direction pour les petits écrans */
                align-items: flex-start;
                /* Alignement à gauche */
            }

            .article,
            .chat-section {
                padding: 15px;
                /* Ajustement du padding */
            }

            .product-card {
                margin: 10px;
                /* Réduction de l'espacement sur mobile */
                max-width: 90%;
                /* Plus de largeur sur petits écrans */
            }
        }
    </style>
    <div style="margin-top: 60px; 
            margin-bottom: 60px;
            overflow-y: auto;
            flex: 1;
            padding: 20px;
            background-color: white;"
        class="container mt-5">
        <!-- Header Section -->
        <div class="header-a bg-white text-center d-flex flex-row align-items-center fixed-top pt-4 px-4 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-user" style="font-size: 40px;"></i>
                @if (Auth::guard('client')->check())
                    <span class="ms-2">{{ Auth::guard('client')->user()->pseudo }}</span>
                @endif
            </div>
            <div class="d-flex align-items-center">
                <i class="ri-notification-2-line"></i>
                <form action="{{ route('deconnexion') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none" style="font-size: 20px;">
                        <i class="ri-logout-circle-r-line"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-12">
                <div class="group-input input-group d-flex flex-row mb-3">
                    <span style="padding: -10px;" class="icon-radius input-group-text bg-light shadow"><i
                            class="fa-solid fa-search"></i></span>
                    <input type="search"
                        class="input-radius form-control shadow @error('recherche') is-invalid @enderror" id="recherche"
                        placeholder="Que recherchez-vous ?" name="recherche">
                    <a href="#" style="height: 60%;" class="icon-radius input-group-text shadow">
                        <i style="padding: 10px;" class="fa-solid fa-sliders bg-primary text-light rounded-3"></i>
                    </a>
                    @error('recherche')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Article Section -->
        <div class="col-sm-12 d-flex flex-row justify-content-between align-items-center m-2">
            <h4 class="fw-bold text-nowrap">Quelques articles</h4>
            <a href="#" class="text-uppercase text-decoration-none fw-bold text-nowrap">Tout voir <i
                    class="fa-solid fa-angle-right"></i></a>
        </div>
        {{-- carroussel des articles --}}
        <div id="articlesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($articles as $index => $article)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="article"
                            style="position: relative; background-image: url('images/{{ $article->image }}'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; padding: 20px; color: white; border-radius: 10px;">
                            <div class="overlay"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); border-radius: 10px;">
                            </div>

                            <h6 class="mb-2 fs-2" style="padding: 5px; position: relative;">{{ $article->libelle }}</h6>
                            <p style="padding: 10px; position: relative; font-size: 20px">
                                {{ \Illuminate\Support\Str::words($article->resume, 9, '...') }}</p>
                            <a href="{{ $article->lien }}" class="fs-4 text-decoration-none text-light"
                                style="padding: 5px; border-radius: 5px; position: relative;">Lire l'article <i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contrôles du carrousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#articlesCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#articlesCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>

        <!-- Produits Section -->
        <div class="col-sm-12 d-flex flex-row justify-content-between align-items-center m-2">
            <h3 class="fw-bold text-nowrap">Produits phare <span>🔥</span></h3>
            <a href="#" class="text-uppercase text-decoration-none fw-bold text-nowrap">Tout voir <i
                    class="fa-solid fa-angle-right"></i></a>
        </div>
        <div class="d-flex overflow-auto products">
            <!-- Cartes des produits -->
            @foreach ($produits as $produit)
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                    <div class="product-card text-center p-3 shadow d-flex flex-column justify-content-around" style="border-radius: 10px;">
                        {{-- <div class="wishlist-icon" style="position: absolute; top: 10px; right: 10px;">
                            <a href="{{ route('ajouter-produit', $produit->id) }}">
                                <i class="ri-shopping-cart-2-line"></i></a>
                        </div> --}}
                        <div>
                            <img style="width: 100%;" src="{{ asset('images/' . $produit->image) }}"
                            alt="{{ $produit->libelle }}" class="img-fluid mb-3 rounded-3" style="border-radius: 10px;">
                        </div>
                        <div>
                            <p class="mb-1" style="font-size: 1.1em; font-weight: 500;">{{ $produit->libelle }}</p>
                            <p style="font-size: 1.2em; font-weight: bold; color: #1d327f;">{{ $produit->prix }} FCFA</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chat Section -->
        <div class="chat-section p-4 bg-white rounded shadow-sm">
            <h3 class="mb-3 fw-bold">Chat en direct</h3>

            <div class="p-4 bg-white rounded shadow mb-4">
                <h5>Discutez avec un professionnel de santé</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-dark mb-0">Posez des questions, obtenez des conseils et discutez en temps réel avec
                        des experts de la santé.</p>
                    <a style="background-color: blueviolet; color: white;" href="{{ url('liste-admin') }}"
                        class="rounded-circle p-3">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- cartes de docteurs -->
            <div class="d-flex overflow-auto justify-content-start">
                @foreach ($admins as $admin)
                    <div class="doctor-card p-3 bg-white rounded shadow text-left m-2"
                        style="min-width: 250px; max-width: 300px; display: flex; align-items: center;">
                        <!-- Image du docteur -->
                        <img src="{{ asset(env('ASSET_PATH', '').'images/'. $admin->image) }}" alt="{{ $admin->name }}" class="rounded-3 mr-3"
                            style="width: 80px; height: 80px;">

                        <!-- Contenu de la carte -->
                        <div class="doctor-info">
                            <h6 class="mb-1 font-weight-bold">{{ $admin->name }}</h6>
                            <p class="text-muted mb-1">5 ans d'expérience</p>
                            <div class="specialty-badge bg-light text-primary px-2 py-1 rounded d-inline-block">
                                <i class="fas fa-user-md"></i> {{ $admin->specialite }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- suivi des menstruations --}}
        <div class="chat-section p-4 bg-white rounded shadow-sm">
            <h3 class="mb-3 fw-bold">Suivi des menstruations</h3>

            <div class="p-4 bg-white rounded shadow mb-4">
                <h5>Rappels de prise de contraceptifs</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-dark mb-0">Tenez un journal précis de votre cycle menstruel et recevez des
                        prévisions
                        personnalisées.</p>
                    <a style="background-color: blueviolet; color: white;" href="{{ url('liste-admin') }}"
                        class="rounded-circle p-3">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Masquer le preloader et afficher le contenu principal après le chargement complet
    window.addEventListener('load', function() {
        document.getElementById('preloader').style.display = 'none';
        document.getElementById('main-content').style.display = 'block';
    });
</script>
@include('partials.nav')
@include('partials.footer')
