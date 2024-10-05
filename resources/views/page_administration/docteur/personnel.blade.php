@extends('master')
@section('content')
@php
$total = 0
@endphp
@if (Auth::guard('admin')->check())
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
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
                    <h1 class="m-0">Gestion des docteurs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a></li>
                        <li class="breadcrumb-item active">Docteurs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
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


        <button type="button" class="btn btn-primary float-right mx-4 my-2" data-bs-toggle="modal"
            data-bs-target="#ajouter">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus"
                viewBox="0 0 16 16">
                <path
                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                <path fill-rule="evenodd"
                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
            </svg>
            Ajouter
        </button>
        <table id="table_personnelle" class="display">
            <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th>nom</th>
                    <th>email</th>
                    <th>specialite</th>
                    {{-- <th>contact</th> --}}
                    <th>image</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $personnel as $personnel )
                <tr>
                    <td>{{ $personnel -> id }}</td>
                    <td>{{ $personnel -> name }}</td>
                    <td>{{ $personnel -> email }}</td>
                    <td>{{ $personnel -> specialite }}</td>
                    {{-- <td>{{ $personnel -> role }}</td> --}}
                    <td> <img src="/images/{{ $personnel->image }}" width="96" height="96" alt="image personnel"> </td>
                    {{-- <td>{{ $personnel -> created_at }}</td> --}}
                    <td>
                        <form method="post" enctype="multipart/form-data">
                            <a href=" {{ route('personnels.show', $personnel->id) }} "
                                class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#voir{{ $personnel->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-eye" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                            </a>
                            <a href=" {{ route('personnels.edit', $personnel->id) }} "
                                class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modifier{{ $personnel->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>

                            <a href="{{ route('personnels.destroy', $personnel->id) }} "
                                class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#supprimer{{ $personnel->id }}" data-bs-whatever="@mdo"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                </svg>
                            </a>

                        </form>

                    </td>
                </tr>
                <!-- debut Modal show -->
                @include('page_administration.docteur.personnelShow')
                <!-- fin modal show -->
                <!-- debut Modal modifier -->
                @include('page_administration.docteur.personnelEdit')
                <!-- fin modal modifier -->
                <!-- debut Modal suppression -->
                @include('page_administration.docteur.personnelDestroy')
                <!-- fin modal suppression -->

                @endforeach
                <!-- debut Modal ajouter -->
                @include('page_administration.docteur.personnelCreate')
                <!-- fin modal ajouter -->

            </tbody>
        </table>
        <!-- /.content -->
    </div>
</div><!-- /.row -->

@endsection