@include('partials.head')
@include('partials.header')

<style>
    .doctor-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .appointment-btn {
        width: 100%;
        background-color: #530c78de;
        color: white;
        padding: 15px;
        border-radius: 50px;
        font-size: 1.2rem;
    }
    .appointment-btn i {
        float: right;
        color: white;
    }
    .doctor-info {
        margin-top: 20px;
    }
    .discuss-btn {
        width: 100%;
        background-color: #e6f4ff;
        color: #007bff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
    }
    .container {
        margin-top: 30px;
    }
</style>

<div style="margin-top: 60px; 
margin-bottom: 60px;
overflow-y: auto;
flex: 1;
padding: 20px;
background-color: white;" class="container">
    <div class="row">
        <!-- Doctor Image -->
        <div class="col-12">
            <img src="/images/{{ $admin->image }}" alt="{{ $admin->name }}" class="doctor-image">
        </div>

        <!-- Doctor Information -->
        <div class="col-12 doctor-info">
            <h3 class="fw-bold">{{ $admin->name }}</h3>
            <p class="fw-bold mb-0">{{ $admin->specialite }}</p>
            <p class="my-0"><i class="ri-phone-line"></i> (+228) 90 08 73 03</p>
            <p class="my-0"><i class="ri-map-pin-line"></i> 2753, Bd Félix Houphouët Boigny</p>
            <div class="fw-bold d-flex mt-1">
                <i class="ri-time-line bg-primary text-white p-3 rounded-3"></i> 
                <div class="d-flex flex-column">
                    <p class="my-0 mx-2">08h00 - 12h00 à 14h00 - 18h00 </p>
                    <p class="my-0 mx-2 fw-light">Horairede consultation</p>
                </div>
            </div>
        </div>

        <!-- Discuss Button -->
        <div class="col-12 text-center my-3">
            <a href="#" class="discuss-btn text-decoration-none fw-bold px-4"> <i class="ri-chat-3-line"></i>Discuter</a>
        </div>

        <!-- Description -->
        <div class="col-12 mt-3">
        <h5>Description</h5>
            <p class="">
                Polyclinique dans un immeuble de trois niveaux, avec plusieurs services techniques, la clinique 
                BARRUET assure un fonctionnement 24h/24. Des consultations d'urgence et simples sont réalisées dans 
                des spécialités diverses.
            </p>
        </div>

        <!-- Appointment Button -->
        <!-- boutton pour prendre un rendez-vous-->
        <div class="col-sm-12 total-container">
          
            <a style="width: 80%;" href="#"
                class="checkout-btn text-decoration-none fs-4">Prendre un rendez-vous <i style="color: blueviolet"
                    class="fas fa-arrow-right bg-white p-2 float-end rounded-circle"></i></a>
        </div>
    </div>
</div>
@include('partials.nav')
@include('partials.footer')
