@extends('master')
@section('content')
@php
$total = 0
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row m-4">
                <div class="col-sm-6">
                    <h1 class="m-0">Caterogie</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a></li>
                        <li class="breadcrumb-item active">Categorie</li>
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

    <button type="button" class="btn btn-primary float-right mx-4 my-2" data-bs-toggle="modal" data-bs-target="#ajouter"
        data-bs-whatever="@mdo">Ajouter</button>

    <!-- /.content-header -->
    <div class="container-fluid">
        <table id="table_personnelle" class="display">
            <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th>Nom de la Categorie</th>
                    {{-- <th>Date de creation</th> --}}
                    <!-- <th>Date de modification</th> -->
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                <tr>
                    <td>{{ $categorie->id }}</td>
                    <td>{{ $categorie->libelle }}</td>
                    {{-- <td>{{ $categorie->created_at }}</td> --}}
                    {{-- <!-- <td>{{ $categorie->updated_at }}</td> --> --}}
                    <td>
                        <a href="" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modifier{{ $categorie->id }}" data-bs-whatever="@mdo"><svg
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a>
                        <a href="" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#supression{{ $categorie->id }}" data-bs-whatever="@mdo"><svg
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                            </svg>
                        </a>
                    </td>
                </tr>

            </tbody>

            <!-- Modal de modification de catégorie -->
            <div class="modal fade" id="modifier{{ $categorie->id }}" tabindex="-1"
                aria-labelledby="modifierLabel{{ $categorie->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifierLabel{{ $categorie->id }}">MODIFIER LA CATEGORIE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('modifier', ['id' => $categorie->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="libelle" class="form-label">Nom de la catégorie</label>
                                    <input type="text" class="form-control" id="libelle" name="libelle"
                                        value="{{ $categorie->libelle }}" required>
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
            <!-- edit modal  -->

            <!-- Confirmation de supression -->
            <div class="modal fade" id="supression{{ $categorie->id }}" tabindex="-1"
                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cette catégorie ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form action="{{ route('destroy', ['id' => $categorie->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de confirmation supression -->

            @endforeach
        </table>
    </div>

    <!-- ajouter categorie modal -->
    <div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AJOUTER UNE CATEGORIE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control" id="nom" name="libelle" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
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