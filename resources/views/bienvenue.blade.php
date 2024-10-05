<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #fff;
            text-align: center;
            font-family: 'Afacad Flux', Arial, sans-serif;;
        }
        .header img {
            width: 120px;
        }
        .content img {
            width: 150px;
        }
        .pagination-dots {
            margin-top: 10px;
        }
        .pagination-dots .dot {
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #9a76b9;
            border-radius: 50%;
            display: inline-block;
        }
        .pagination-dots .active {
            background-color: #563d7c;
        }
        .next-btn {
            background-color: #563d7c;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
        }
        .next-btn i {
            font-size: 18px;
        }
        .skip-link {
            color: #563d7c;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="welcome-screen" class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <!-- Logo -->
            <div class="header">
                <img src="{{ asset(env('ASSET_PATH', '').'images/VENUS-SANS-FOND.PNG')}}" alt="Logo">
            </div>
    
            <!-- Image de la maison avec livraison -->
            <div class="content my-4">
                <img src="{{ asset(env('ASSET_PATH', '').'images/delivery.png') }}" alt="House Delivery">
            </div>  
    
            <!-- Texte de présentation -->
            <h5 class="mb-4 fs-3 fw-bold">Commandez et faites vous livrer en toute discrétion</h5>
    
            <!-- Pagination des étapes -->
            <div class="pagination-dots">
                <span class="dot active"></span>
                {{-- <span class="dot"></span>
                <span class="dot"></span> --}}
            </div>
    
            <!-- Bouton Suivant -->
            <div class="next-btn" id="next-btn">
                <i class="fas fa-arrow-right"></i>
            </div>
    
            <!-- Lien Passer -->
            <a href="#" class="skip-link" id="skip-link">Passer</a>
        </div>
    
    </div>

    <div id="app-content" style="display: none;">
        <p></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function hideWelcomeScreen() {
            document.getElementById('welcome-screen').style.display = 'none';
            document.getElementById('app-content').style.display = 'block';
            localStorage.setItem('hasSeenWelcomeScreen', 'true');
        }

        window.onload = function() {
            if (!localStorage.getItem('hasSeenWelcomeScreen')) {
                document.getElementById('welcome-screen').style.display = 'block';
                document.getElementById('app-content').style.display = 'none';
            } else {
                document.getElementById('app-content').style.display = 'block';
            }
        }

        // Ajoutez des gestionnaires d'événements pour les actions "Suivant" et "Passer"
        document.getElementById('next-btn').addEventListener('click', function() {
            hideWelcomeScreen();
            window.location.href = '/page-connexion'; // Rediriger après avoir cliqué sur "Suivant"
        });

        document.getElementById('skip-link').addEventListener('click', function(e) {
            e.preventDefault();  // Empêche le comportement par défaut du lien
            hideWelcomeScreen();
            window.location.href = '/page-connexion'; // Rediriger après avoir cliqué sur "Passer"
        });
    </script>
</body>
</html>
