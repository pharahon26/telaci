@extends('layouts.front_app')
@section('content')
    <div class="container">

        <center>
            <img src="{{ asset(auth()->user()->photo_profil)}}" width="100px" height="100px"
                alt="">
        </center>
        <form action="{{ route('profil.updatepicture', $dataProfil->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row ">
                <h3 class="text-black text-center">
                    Formulaire de modification de photo de profil
                    <br><br>
                </h3>
                @include('components.message')
                <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
                    <label for="" class="text-black">Piece d'identité recto</label>
                    <input type="file" name="photo" class="form-control" value="" required><br>
                </div>


                <center>
                    <button type="submit" class="btn btn-primary">METTRE MA PHOTO A JOUR</button>
                </center>
            </div>
        </form>
    </div>
@endsection
