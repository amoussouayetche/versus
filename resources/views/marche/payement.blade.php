@include('partials.head')
@include('partials.header')

<style>
    .payment-option {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .payment-option img {
        width: 50px;
        height: auto;
        margin-right: 15px;
    }

    .payment-option:hover {
        background-color: #e9ecef;
    }
</style>

<div style="margin-top: 60px; 
margin-bottom: 60px;
overflow-y: auto;
flex: 1;
padding: 20px;
background-color: white;" class="container mt-5">
    <div class="row ">
        <div class="col-sm-12">
            <h3 class="text-center mb-4">Utilisez l'un des moyens de
                paiement
                ci-dessous pour payer ... FCFA</h3>

            <div class="payment-option">
                <a href="{{ url('page-commande') }}"class="text-dark text-decoration-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="MasterCard">
                <span>MasterCard</span>
                </a>
                
            </div>

            <div class="payment-option">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Carte Visa">
                <span>Carte Visa</span>
            </div>

            <div class="payment-option">
                <img src="https://cdn.brandfetch.io/id6Mh6QAif/w/400/h/400/theme/dark/icon.jpeg?k=id64Mup7ac&t=1720791740569"
                    alt="Moov Money">
                <span>Moov Money</span>
            </div>

            <div class="payment-option">
                <img src="https://plus.unsplash.com/premium_photo-1681589453747-53fd893fa420?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Portefeuille">
                <span>Portefeuille</span>
            </div>

            <div class="payment-option">
                <img src="https://plus.unsplash.com/premium_photo-1680230177520-e87271066e5d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Paiement par cash">
                <span>Paiement par cash</span>
            </div>
        </div>
    </div>
</div>
@include('partials.nav')
@include('partials.footer')
