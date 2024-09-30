<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- tailwind --}}
    {{-- @vite('resources/css/app.css') --}}

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- icone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <meta name="apple-mobile-web-app-status-bar" content="#01d679">
    <meta name="mobile-web-app-capable" content="yes">
    
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="apple-touch-icon" sizes="16x16" href="/pwa/icons/ios/16.png">
    <link rel="apple-touch-icon" sizes="20x20" href="/pwa/icons/ios/20.png">
    <link rel="apple-touch-icon" sizes="29x29" href="/pwa/icons/ios/29.png">
    <link rel="apple-touch-icon" sizes="32x32" href="/pwa/icons/ios/32.png">
    <link rel="apple-touch-icon" sizes="40x40" href="/pwa/icons/ios/40.png">
    <link rel="apple-touch-icon" sizes="50x50" href="/pwa/icons/ios/50.png">
    <link rel="apple-touch-icon" sizes="57x57" href="/pwa/icons/ios/57.png">
    <link rel="apple-touch-icon" sizes="58x58" href="/pwa/icons/ios/58.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/pwa/icons/ios/60.png">
    <link rel="apple-touch-icon" sizes="64x64" href="/pwa/icons/ios/64.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/pwa/icons/ios/72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/pwa/icons/ios/76.png">
    <link rel="apple-touch-icon" sizes="80x80" href="/pwa/icons/ios/80.png">
    <link rel="apple-touch-icon" sizes="87x87" href="/pwa/icons/ios/87.png">
    <link rel="apple-touch-icon" sizes="100x100" href="/pwa/icons/ios/100.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/pwa/icons/ios/114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/pwa/icons/ios/120.png">
    <link rel="apple-touch-icon" sizes="128x128" href="/pwa/icons/ios/128.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/pwa/icons/ios/144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/pwa/icons/ios/152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/pwa/icons/ios/167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/pwa/icons/ios/180.png">
    <link rel="apple-touch-icon" sizes="192x192" href="/pwa/icons/ios/192.png">
    <link rel="apple-touch-icon" sizes="256x256" href="/pwa/icons/ios/256.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/pwa/icons/ios/512.png">
    <link rel="apple-touch-icon" sizes="1024x1024" href="/pwa/icons/ios/1024.png">

    <link href="/pwa/icons/ios/1024.png" sizes="1024x1024" rel="apple-touch-startup-image">
    <link href="/pwa/icons/ios/512.png" sizes="512x512" rel="apple-touch-startup-image">
    <link href="/pwa/icons/ios/256.png" sizes="256x256" rel="apple-touch-startup-image">
    <link href="/pwa/icons/ios/192.png" sizes="192x192" rel="apple-touch-startup-image">

    <style>
        :root {
            --violet: #530c78de;
            --gris: #fbfbfbd1;
        }

        body {
            background-color: rgba(215, 212, 212, 0.519);
        }

        .header {
            background-color: var(--violet);
        }

        .icon-radius,
        .input-radius {
            border-radius: 10px;
            border: none;
            background-color: #fbfbfbd1;
            padding: 15px;
        }

        .group-input {
            margin-block: 20px;
        }

        .center-container {
            height: 100vh;
            display: flex;
            justify-content: center;
        }

        .active {
            color: #530c78de !important; 
        }
        
        .category-list li.active {
            background-color: #530c78;
            color: #fff;
        }

        /* element de la liste catégorie */
        .category-list li {
            padding: 10px 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            white-space: nowrap; /* Empêche le retour à la ligne */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .category-list li:hover {
            background-color: #530c78;
            color: #fff;
        }

        /* produit card */
        .card {
            /* width: 50%; */
            border: none;
            background-color: #f5f7fa;
            border-radius: 15px;
            text-align: center;
            position: relative;
        }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .product-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .product-price {
            font-size: 18px;
            color: #007bff;
            font-weight: bold;
        }

        .wishlist-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #ff5e5e;
        }

        .wishlist-icon i {
            font-size: 24px;
            cursor: pointer;
        }

        .wishlist-icon i:hover {
            color: #e60000;
        }

        /* panier */
        .cart-item {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
            margin-left: 15px;
        }

        .item-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .item-price {
            color: #007bff;
            font-weight: bold;
            margin-top: 10px;
        }

        .quantity-input {
            width: 60px;
        }

        .total-container {
            border-top: 1px solid #e0e0e0;
            padding: 15px 0;
            margin-top: 20px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
        }

        .checkout-btn {
            background-color: #800080;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
        }

        .delete-icon {
            cursor: pointer;
            color: #ff5e5e;
            margin-left: 10px;
        }
    </style>
    
</head>
