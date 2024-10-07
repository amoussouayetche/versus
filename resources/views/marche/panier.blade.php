@include('partials.head')
@include('partials.header')

<div style="margin-top: 60px; 
        margin-bottom: 60px;
        overflow-y: auto;
        flex: 1;
        padding: 20px;
        background-color: white;"
    class="container">
    <div class="row">
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                {{-- Article du panier --}}
                <div class="col-12 cart-item d-flex align-items-center shadow" rowId="{{ $id }}">
                    <img src="{{ asset(env('ASSET_PATH', '').'images/'. $details['image']) }}" alt="image du produit" class="item-image m-2">
                    <div class="item-info">
                        <h5 class="item-title text-truncate fs-4">
                            {{ \Illuminate\Support\Str::words($details['libelle'], 10, '...') }}</h5>
                        {{-- <p class="text-muted">{{ \Illuminate\Support\Str::words($details['description'], 10, '...') }}
                        </p> --}}
                        <span class="item-price fs-5">{{ $details['prix'] }} fcfa</span>
                    </div>
                    <div class="flex-column justify-content-between m-3">
                        {{-- boutton de retrait de produit du panier --}}
                        <a style="position: relative; left: 80px; top: -8px;" class="text-decoration-none" href="{{ route('annuler-produit', ['libelle' => $details['libelle']]) }}"
                            data-bs-toggle="modal" data-bs-target="#supprimer" data-bs-whatever="@mdo"><i
                                class="fas fa-trash-alt delete-icon text-dark"></i>
                        </a>
                        {{-- gerer la quantit --}}
                        <div class="d-flex align-items-center">
                            <form action="{{ route('update-quantity', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="decrease">
                                <button class="btn btn-outline-primary btn-sm py-0">-</button>
                            </form>

                            <input type="number" class="bg-white border-0 text-center fw-bold form-control quantity-input mx-0 py-0" min="1"
                                value="{{ $details['quantity'] }}" readonly>
                            <form action="{{ route('update-quantity', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="increase">
                                <button class="btn btn-outline-primary text-white btn-sm bg-primary py-0">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- modal annulation confirmation --}}
            <div class="modal fade" id="supprimer" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer l'annulation du produit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir retirer ce produit du panier ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form action="{{ route('annuler-produit', ['libelle' => $details['libelle']]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- boutton pour aller a l'achat -->
        <div class="col-sm-12 total-container mt-4">
            @php $total = 0; @endphp
            @if (session('cart') == null)
                <h2 style="height: 100vh; width: 100vw">Panier vide...</h2>
            @else
                @foreach (session('cart') as $id => $details)
                    @php $total += $details['prix'] * $details['quantity']; @endphp
                @endforeach
                <p class="total-price d-flex justify-content-between mx-3">Total: <span
                        class="text-primary">{{ $total }} fcfa</span></p>
                <a style="width: 80%;" href="{{ url('moyen-payement') }}"
                    class="checkout-btn text-decoration-none fs-4">Acheter maintenant <i style="color: blueviolet"
                        class="fas fa-arrow-right bg-white p-2 float-end rounded-circle"></i></a>
            @endif
        </div>
    </div>
</div>
@include('partials.nav')
@include('partials.footer')
