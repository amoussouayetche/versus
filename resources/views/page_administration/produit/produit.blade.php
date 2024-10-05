@extends('master')
@section('content')
    @php
        $total = 0;
    @endphp
    @if (Auth::guard('admin')->check())
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('liste-client') }}" class="nav-link">Retouner au chat</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('deconnexion-a') }}" method="post">
                        @csrf
                        <button class="nav-link btn btn-link" type="submit">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    @endif
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row m-4">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gestion des produits</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a></li>
                            <li class="breadcrumb-item active">Produits</li>
                        </ol>
                    </div><!-- /.col -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <button type="button" class="btn btn-primary float-right mx-4 my-2" data-bs-toggle="modal"
                data-bs-target="#ajouter">Ajouter</button>

            <!-- Main content -->
            <table id="table_personnelle" class="display">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>libelle</th>
                        <th>description</th>
                        <th>prix</th>
                        <th>categorie</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->libelle }}</td>
                            <td>{{ \Illuminate\Support\Str::words($produit->description, 10, '...') }}</td>
                            <td>{{ $produit->prix }}</td>
                            <td>{{ $produit->categorie }}</td>

                            <td> <img src="{{ asset(env('ASSET_PATH', '').'images/'.$produit->image ) }}" width="100" height="100"> </td>
                            <td>
                                <a href="" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#voir{{ $produit->id }}" data-bs-whatever="@mdo"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                        class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                </a>
                                <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modifierProduit{{ $produit->id }}" data-bs-whatever="@mdo"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>
                                <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#suprimerProduit{{ $produit->id }}" data-bs-whatever="@mdo"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                </a>

                            </td>
                        </tr>

                        <!-- mofifier produit modal -->
                        <div class="modal fade" id="modifierProduit{{ $produit->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MODIFIER LE PRODUIT</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('modifierproduit', ['id' => $produit->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Libelle</label>
                                                <input type="text" class="form-control" id="nom"
                                                    value="{{ $produit->libelle }}" name="libelle" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Description</label>
                                                <input type="text" class="form-control" id="nom"
                                                    value="{{ $produit->description }}" name="description" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Prix</label>
                                                <input type="text" class="form-control" value="{{ $produit->prix }}"
                                                    id="nom" name="prix" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Image</label>
                                                <input class="form-control" type="file" value="{{ $produit->image }}"
                                                    id="formFile" name="image">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Catégorie: </label>
                                                <select id="categorie" name="categorie" class="form-control">
                                                    <option value="{{ $produit->categorie }}">
                                                        {{ $produit->categorie }}
                                                    </option>
                                                    @foreach ($categories as $categorie)
                                                        <option value="{{ $categorie->libelle }}">
                                                            {{ $categorie->libelle }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal  -->

                        <!-- suprimer produit modal -->
                        <div class="modal fade" id="suprimerProduit{{ $produit->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer ce produit?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('detruireproduit', ['id' => $produit->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal  -->

                        <!-- Voir produit modal -->
                        <div class="modal fade " id="voir{{ $produit->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMATION SUR LE PRODUIT
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('detruireproduit', ['id' => $produit->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <img src="{{ asset(env('ASSET_PATH', '').'images/'.$produit->image ) }}" width="300" height="300"
                                                    class="rounded-3 mx-auto d-block" alt="image du personnel">
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Nom: </label>
                                                <span>{{ $produit->libelle }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Description: </label>
                                                <span>{{ $produit->description }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Prix : </label>
                                                <span>{{ $produit->prix }} fcfa</span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Categorie: </label>
                                                <span>{{ $produit->categorie }}</span>
                                            </div>

                                            <div class="float-right">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <!-- <button type="submit" class="btn btn-primary">Ajouter</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal  -->
                    @endforeach
                </tbody>
            </table>
            <!-- /.content -->

            <!-- ajouter produit modal -->
            <div class="modal fade div_modal_ajouter" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN PRODUIT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Libelle du produit</label>
                                    <input type="text" class="form-control" value="{{ old('libelle') }}"
                                        id="nom" name="libelle" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description du produit</label>
                                    <input type="text" class="form-control" value="{{ old('description') }}"
                                        id="description" name="description" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="number" value="{{ old('prix') }}" class="form-control"
                                        id="nom" name="prix" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nom" class="form-label">Catégorie</label>
                                    <select name="categorie" id="categorie" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->libelle }}">
                                                {{ $categorie->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image: </label>
                                    <input type="file" value="{{ old('image') }}" class="form-control"
                                        id="image" name="image" required>
                                    <div id="imageHelp" class="form-text">Formats acceptés : JPEG, PNG.</div>
                                    <div id="imageHelp" class="form-text">Taille acceptées : 4Mo.</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin modal  -->
        </div>
    </div><!-- /.row -->

@endsection
