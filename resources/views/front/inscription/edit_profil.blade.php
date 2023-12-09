@extends('layouts.front_app')
@section('content')
    <div class="container">
        @include('components.message')
        <center>
            <img src="{{ asset('assets/img/users/photo') }}/{{ $dataProfil->photo }}" width="100px" height="100px"
                alt="">
        </center>
        <form action="{{ route('profil.update', $dataProfil->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row ">
                <h3 class="text-black text-center">
                    Formulaire de modification de profil
                    <br><br>
                </h3>
                <div class="col-3">
                    <label for="" class="text-black">Nom & prenoms</label>
                    <input type="text" name="name" class="form-control" value="{{ $dataProfil->name }}" required>
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Numero de téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $dataProfil->phone1 }}" required>
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Second numero de téléphone</label>
                    <input type="text" name="phone2" class="form-control" value="">
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Lieu de naissance</label>
                    <input type="text" name="lieu_naissance" class="form-control" value="{{ old('lieu_naissance') }}"
                        required><br>
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}"
                        required>
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Nationalité</label>
                    <input type="text" name="nationalite" class="form-control" value="{{ old('nationalite') }}" required>
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Ville de residence</label>
                    <input type="text" name="domicile" class="form-control" value="{{ old('domicile') }}" required>
                </div>
                <div class="col-3">
                    <label for="" class="text-black">Numero de carte d'identité/passeport</label>
                    <input type="text" name="numero_cni" class="form-control" value="{{ old('numero_cni') }}"
                        required><br>
                </div>
                <div class="col-4">
                    <label for="" class="text-black">Sexe</label>
                    <select name="genre" class="form-control" id="" required>
                        <option value="M">Masculin</option>
                        <option value="F">Feminin</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="" class="text-black">Piece d'identité recto</label>
                    <input type="file" name="cni_recto" class="form-control" value="" required><br>
                </div>
                <div class="col-4">
                    <label for="" class="text-black">Piece d'identité verso</label>
                    <input type="file" name="cni_verso" class="form-control" value="" required><br>
                </div>

                <center>
                    <button type="submit" class="btn btn-warning">JE CONFIRME MES INFORMATIONS PERSONNELLES</button>
                </center>
            </div>
        </form>
    </div>
@endsection
