{{-- navigation bottom --}}
<nav class="bg-white p-3 fixed-bottom">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-12 d-flex flex-row justify-content-center justify-content-evenly align-items-center">
                <a href="{{ url('accueil') }}"
                    class="fw-bold text-dark text-uppercase text-decoration-none d-flex flex-column text-center {{ Request::is('accueil') ? 'active' : 'text-dark' }}">
                    <i class="fa fa-home"></i>
                    <p>Accueil</p>
                </a>
                <a href="{{ url('boutique') }}"
                    class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center {{ Request::is('boutique') ? 'active' : 'text-dark' }}">
                    <i class="fa fa-shop"></i>
                    <p>Boutique</p>
                </a>
                @if (Auth::guard('admin')->check())
                    <a href="{{ url('liste-client') }}"
                        class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center {{ Request::is('chat') ? 'active' : 'text-dark' }}">
                        <i class="fa fa-comments"></i>
                        <p>chat</p>
                    </a>
                @elseif (Auth::guard('client')->check())
                    <a href="{{ url('liste-admin') }}"
                        class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center {{ Request::is('chat') ? 'active' : 'text-dark' }}">
                        <i class="fa fa-comments"></i>
                        <p>chat</p>
                    </a>
                @endif
                
                <a href="{{ url('info') }}"
                    class="fw-bold text-dark text-uppercase text-decoration-none  d-flex flex-column text-center {{ Request::is('info') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <p>Information</p>
                </a>
            </div>
        </div>
    </div>
</nav>
