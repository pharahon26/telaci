@extends('layouts.front_app')
@section('content')
<div class="container">
    <h2>Modifier les photos de la maison ayant la reference : {{$data->ref}}</h2>

    @include('components.message')
    <form method="post" action="{{route('catalogue.updatepicture',$data->ref)}}" enctype="multipart/form-data">
        @csrf
        <!-- Champs pour latitude -->
        <div class="form-group ">
            <label for="latitude" class="perso">Commune:</label>
            <input type="text" class="form-control" value="{{$data->commune->name}}" readonly>
        </div>

        <!-- Champs pour prix -->
        <div class="form-group">
            <label for="price" class="perso">Prix *:</label>
            <input type="text" name="price" value="{{$data->price}}" class="form-control" readonly>
        </div>

        <!-- Champs pour le nom du propriétaire -->
        <div class="form-group">
            <label for="proprio_name" class="perso">Nom du propriétaire:</label>
            <input type="text" name="proprio_name" value="{{$data->proprio_name}}" readonly class="form-control" >
        </div>

        <!-- Champs pour le numéro de téléphone du propriétaire -->
        <div class="form-group">
            <label for="proprio_telephone" class="perso">Numéro de téléphone du propriétaire:</label>
            <input type="text" name="proprio_telephone" value="{{$data->proprio_telephone}}" readonly class="form-control" >
        </div>

        <!-- Champs pour la description -->
        <div class="form-group">
            <label for="description" class="perso">Description *:</label>
            <textarea name="description" value="" class="form-control" readonly="">{{$data->description}}</textarea>
        </div>

        <!-- Champs pour le nombre de pièces -->
        <div class="form-group">
            <label for="nombre_piece" class="perso">Nombre de pièces:</label>
            <input type="number" name="nombre_piece" min="1" value="{{$data->nombre_piece}}" class="form-control" readonly>
        </div>

        <!-- Champs pour le nombre de salles d'eau -->
        <div class="form-group">
            <label for="nombre_salle_eau" class="perso">Nombre de salles d'eau:</label>
            <input type="number" name="nombre_salle_eau" min="1" value="{{$data->nombre_salle_eau}}" class="form-control" readonly>
        </div>
            <br>
            <div class="form-group">
                <label for="photo" class="perso">Photo de façade:</label>
                <input type="file" class="form-control" name="photo_couverture" class="form-control-file" accept="image/*" required>
            </div>
            <br>
            @foreach($imageData as $item)
                <div class="form-group">
                    <label for="photo-{{ $item->id }}" class="perso">Autre Photo :</label>
                    <input type="file" class="form-control" name="photo{{ $item->id }}" required class="form-control-file" accept="image/*">

                </div>
            @endforeach
            <br>
<!-- Bouton de soumission -->
<button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
</div>
@endsection
