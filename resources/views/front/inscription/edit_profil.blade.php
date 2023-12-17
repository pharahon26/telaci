@extends('layouts.front_app')
@section('content')
    <div class="container">

        <center>
            <img src="{{ asset(auth()->user()->photo_profil)}}" width="100px" height="100px"
                alt="">
        </center>
        <form action="{{ route('profil.update', $dataProfil->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row ">
                <h3 class="text-black text-center">
                    Formulaire de modification de profil
                    <br><br>
                </h3>
                @include('components.message')
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ $dataProfil->nom}}" required
                           placeholder="Nom">
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Prenoms</label>
                    <input type="text" name="prenom" class="form-control" value="{{ $dataProfil->prenoms }}" required
                           placeholder="Prenom">
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Numero de téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $dataProfil->phone1 }}" required><br>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Second numero de téléphone</label>
                    <input type="text" name="phone2" class="form-control" value="{{ $dataProfil->phone2 }}">
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Lieu de naissance</label>
                    <input type="text" name="lieu_naissance" class="form-control" value="{{ $dataProfil->lieu_naissance }}"
                           required><br>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ $dataProfil->date_naissance }}"
                           required>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Nationalité</label>
                    <input type="text" name="nationalite" class="form-control" value="{{ $dataProfil->nationalite }}" required><br>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Ville de residence</label>
                    <input type="text" name="domicile" class="form-control" value="{{ $dataProfil->domicile }}" required>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Numero de carte d'identité/passeport</label>
                    <input type="text" name="numero_cni" class="form-control" value="{{ $dataProfil->numero_cni }}"
                           required><br>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Sexe</label>
                    <select name="genre" class="form-control" id="" required>
                        <option value="M">Masculin</option>
                        <option value="F">Feminin</option>
                    </select>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Piece d'identité recto</label>
                    <input type="file" name="cni_recto" class="form-control" value="" required><br>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <label for="" class="text-black">Piece d'identité verso</label>
                    <input type="file" name="cni_verso" class="form-control" value="" required><br>
                </div>

                <center>
                    <button type="submit" class="btn btn-primary">JE CONFIRME MES INFORMATIONS PERSONNELLES</button>
                </center>
            </div>
        </form>
    </div>
@endsection
