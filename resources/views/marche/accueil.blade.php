@include('partials.head')
<style>
    .header-a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 10px; /* Ajout d'un padding pour plus d'espace */
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
        max-width: 300px; /* Limiter la largeur pour les petits écrans */
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
        height: 300px; /* Hauteur fixe pour maintenir le layout */
    }

    .products {
        margin-bottom: 20px;
    }

    .product-card {
        text-align: center;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0 10px; /* Équilibrage des marges */
        max-width: 200px; /* Limiter la largeur des cartes de produits */
        flex-shrink: 0; /* Empêcher le rétrécissement sur mobile */
    }

    .chat-section {
        background-color: #f0f0f0;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 100px; /* Maintenir un espace pour le contenu suivant */
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

    @media (max-width: 576px) {
        .header-a {
            flex-direction: column; /* Changer la direction pour les petits écrans */
            align-items: flex-start; /* Alignement à gauche */
        }

        .article, .chat-section {
            padding: 15px; /* Ajustement du padding */
        }

        .product-card {
            margin: 10px; /* Réduction de l'espacement sur mobile */
            max-width: 90%; /* Plus de largeur sur petits écrans */
        }
    }
</style>
<div class="container mt-5">
    <!-- Header Section -->
    <div class="header-a bg-white text-center d-flex flex-row align-items-center fixed-top pt-4 px-4 shadow-sm">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-circle-user" style="font-size: 40px;"></i>
            @if (Auth::guard('client')->check())
                <span class="ms-2">{{ Auth::guard('client')->user()->pseudo }}</span>
            @endif
        </div>
        <div class="d-flex align-items-center">
            <i class="fa fa-bell me-3" style="font-size: 20px;"></i>
            <form action="{{ route('deconnexion') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link" style="font-size: 20px;">
                    <i class="fa fa-sign-out-alt"></i>
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


    <!-- Article Section -->
    <div class="col-sm-12 d-flex flex-row justify-content-between align-items-center m-2">
        <h4 class="fw-bold">Quelques articles</h4>
        <a style="font-size: 13px" href="#" class="text-uppercase text-decoration-none fw-bold">Tout voir <i class="fa-solid fa-angle-right"></i></a>
    </div>

    <div class="article" style="background-image: url('https://img.freepik.com/free-photo/african-man-wearing-doctor-uniform-holding-prescription-pills-shock-face-looking-skeptical-sarcastic-surprised-with-open-mouth_839833-9266.jpg?t=st=1727628901~exp=1727632501~hmac=1cf08cf8c71292bd934619d667bb9fd50dc4a06edec594fe6332341a7426f200&w=1060'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: flex-end; padding: 20px; color: white; border-radius: 10px;">
        <h6 class="mb-2" style="background-color: rgba(0, 0, 0, 0.5); padding: 5px;">L'OMS et l'ANRS...</h6>
        <p style="background-color: rgba(0, 0, 0, 0.5); padding: 10px;">La Dr Meg Doherty, directrice du département VIH, hépatite, inf...</p>
        <a href="#" class="text-decoration-none text-light" style="background-color: rgba(0, 0, 0, 0.5); padding: 5px; border-radius: 5px;">Lire l'article <i class="fa fa-arrow-right"></i></a>
    </div>

    <!-- Products Section -->
    <div class="col-sm-12 d-flex flex-row justify-content-between align-items-center m-2">
        <h3 class="fw-bold">Produits phare <span>🔥</span></h3>
        <a href="#" class="text-uppercase text-decoration-none fw-bold">Tout voir <i class="fa-solid fa-angle-right"></i></a>
    </div>
    <div class="d-flex overflow-auto products">
        <!-- Cartes des produits -->
        @for ($i = 0; $i < 5; $i++)
        <div class="product-card text-center p-3 shadow-sm">
            <img src="https://img.freepik.com/free-photo/high-angle-unwrapped-red-condom_23-2148237886.jpg?t=st=1727629306~exp=1727632906~hmac=3f95c78bf2e2580b3cbf624454915ac8d6de6b06f437031e7244950947836067&w=740" alt="Durex - 10 Préservatifs" class="img-fluid mb-3" style="border-radius: 10px;">
            <p class="mb-1" style="font-size: 1.1em; font-weight: 500;">Durex - 10 Préservatifs</p>
            <p style="font-size: 1.2em; font-weight: bold; color: #1d327f;">7000 FCFA</p>
        </div>
        @endfor
    </div>

    <!-- Chat Section -->
    <div class="chat-section p-4 bg-light rounded shadow-sm">
        <h5 class="mb-3">Chat en direct</h5>
        <p class="mb-4">Discutez avec un professionnel de santé</p>
        <a href="{{ url('liste-admin') }}" class="btn btn-primary mb-4">Commencez le chat</a>

        <!-- Doctor Cards -->
        <div class="d-flex flex-row overflow-auto">
            <div class="doctor-card d-flex align-items-center p-3 border rounded mx-2" style="min-width: 200px;">
                <img src="https://via.placeholder.com/50" alt="Dr. Weber" class="rounded-circle mr-3">
                <div>
                    <p class="mb-1 font-weight-bold">Dr. Weber</p>
                    <p class="mb-0 text-muted">Cardiologue</p>
                </div>
            </div>
            <div class="doctor-card d-flex align-items-center p-3 border rounded mx-2" style="min-width: 200px;">
                <img src="https://via.placeholder.com/50" alt="Dr. Meyer" class="rounded-circle mr-3">
                <div>
                    <p class="mb-1 font-weight-bold">Dr. Meyer</p>
                    <p class="mb-0 text-muted">Pédiatre</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.nav')
@include('partials.footer')
