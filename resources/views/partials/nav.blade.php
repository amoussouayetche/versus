{{-- navigation bottom --}}
<nav>
    <div style="position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: white;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;"
        class="container-fluid ">
        <div class="row">
            <div
                class="col-sm-12 fixed-bottom d-flex flex-row justify-content-center justify-content-around align-items-center">
                <a href="{{ url('accueil') }}"
                    class="fw-bold text-dark text-uppercase text-decoration-none d-flex flex-column text-center {{ Request::is('accueil') ? 'active' : 'text-dark' }}">
                    <i class="ri-home-4-line"></i>
                    <p style="font-size: 13px" class="mb-0">Accueil</p>
                </a>
                <a href="{{ url('boutique') }}"
                    class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center {{ Request::is('boutique') ? 'active' : 'text-dark' }}">
                    <i class="ri-store-2-line"></i>
                    <p style="font-size: 13px" class="mb-0">Boutique</p>
                </a>

                <a href="#"
                    style="background-color: blueviolet;
                margin-bottom: 2rem;
                padding: 0 7px;
                font-size: 30px;"
                    class="fw-bold text-uppercase text-decoration-none rounded-circle shadow d-flex flex-column text-center">
                    <i class="ri-arrow-up-double-line text-light"></i>
                </a>
                @if (Auth::guard('admin')->check())
                    @php
                        // Récupérer l'utilisateur connecté
$user = Auth::guard('admin')->user();
                    @endphp

                    <form id="auto-login-form" action="http://localhost:8000/login" method="POST"
                        style="display: none;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="password" value="{{ $user->password }}">
                    </form>

                    <a href="#"
                        class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center"
                        onclick="document.getElementById('auto-login-form').submit();">
                        <i class="ri-chat-3-line"></i>
                        <p style="font-size: 13px" class="mb-0">chat</p>
                    </a>
                @elseif (Auth::guard('client')->check())
                @php
                    // Récupérer l'utilisateur connecté
                    $user = Auth::guard('client')->user();
                    // $sessionId = session()->getId(); // Récupérer l'ID de session actuel
                @endphp
            
                <form id="auto-login-form" action="http://localhost:8000/login" method="POST" style="display: none;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="email" value="{{ $user->tel }}">
                    <input type="hidden" name="password" value="{{ $user->password }}">
                    {{-- <input type="hidden" name="session_id" value="{{ $sessionId }}">  <!-- Ajouter l'ID de session --> --}}
                </form>
            
                <a href="#" class="fw-bold text-dark text-uppercase text-decoration-none d-flex flex-column text-center"
                   onclick="document.getElementById('auto-login-form').submit();">
                    <i class="ri-chat-3-line"></i>
                    <p style="font-size: 13px" class="mb-0">chat</p>
                </a>
            @endif
            

                <a href="{{ url('liste-admin') }}"
                    class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center {{ Request::is('info') ? 'active' : 'text-dark' }}">
                    <i class="ri-file-info-line"></i>
                    <p style="font-size: 13px" class="mb-0">Information</p>
                </a>
            </div>
        </div>
    </div>
</nav>
