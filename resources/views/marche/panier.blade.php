@include('partials.head')
@include('partials.header')

<div style="margin-top: 80px; margin-bottom: 100px" class="container">
    <div class="row">

        {{-- message erreur/succès --}}
        {{-- <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div> --}}

        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                {{-- Article du panier --}}
                <div class="col-12 cart-item d-flex align-items-center" rowId="{{ $id }}">
                    <img src="{{ $details['image'] }}" alt="image du produit" class="item-image">
                    <div class="item-info">
                        <h5 class="item-title text-truncate">
                            {{ \Illuminate\Support\Str::words($details['libelle'], 10, '...') }}</h5>
                        {{-- <p class="text-muted">{{ \Illuminate\Support\Str::words($details['description'], 10, '...') }}
                        </p> --}}
                        <span class="item-price">{{ $details['prix'] }} fcfa</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <form action="{{ route('update-quantity', $id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="decrease">
                            <button class="btn btn-outline-secondary btn-sm">-</button>
                        </form>

                        <input type="number" class="form-control quantity-input mx-2" min="1"
                            value="{{ $details['quantity'] }}" readonly>

                        <form action="{{ route('update-quantity', $id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="increase">
                            <button class="btn btn-outline-secondary btn-sm">+</button>
                        </form>
                    </div>

                    <a href="{{ route('annuler-produit', ['libelle' => $details['libelle']]) }}" data-bs-toggle="modal"
                        data-bs-target="#supprimer" data-bs-whatever="@mdo"><i
                            class="fas fa-trash-alt delete-icon"></i></a>
                </div>
                {{-- modal suppression confirmation --}}
                <div class="modal fade" id="supprimer" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la
                                    suppression</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cette commande ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Annuler</button>
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
            @endforeach
        @endif

        <!-- boutton pour aller a l'achat -->
        <div class="col-sm-12 total-container mt-4">
            @php $total = 0; @endphp
            @if (session('cart') == null)
                <h2>Panier vide...</h2>
                @else
                @foreach (session('cart') as $id => $details)
                @php $total += $details['prix'] * $details['quantity']; @endphp
            @endforeach
            @endif
            <p class="total-price">Total: {{ $total }} fcfa</p>
            <a href="{{ url('moyen-payement') }}" class="checkout-btn text-decoration-none">Acheter maintenant <i
                    class="fas fa-arrow-right bg-white text-dark p-2 rounded-circle"></i></a>
        </div>
    </div>
</div>
@include('partials.nav')
@include('partials.footer')
