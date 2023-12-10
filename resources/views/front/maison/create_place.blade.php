@extends('layouts.front_app')
@section('content')
<div class="container">
    <h2>Ajouter une nouvelle maison</h2>
    <h4 class="text-danger">les champs marqués d'une * sont obligatoires</h4><br>
    @include('components.message')
    <form method="post" action="{{route('catalogue.store')}}" enctype="multipart/form-data">
        @csrf
        <!-- Champs pour latitude -->
        <div class="form-group">
            <label for="latitude" class="perso">Commune:</label>
            <select name="commune_id" required class="form-control" id="">
                @foreach($communes as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
<!--
        <div class="form-group">
            <label for="latitude">Latitude:</label>
            <input type="text" name="latitude" class="form-control" >
        </div>

        &lt;!&ndash; Champs pour longitude &ndash;&gt;
        <div class="form-group">
            <label for="longitude">Longitude:</label>
            <input type="text" name="longitude" class="form-control" >
        </div>-->

        <!-- Champs pour prix -->
        <div class="form-group">
            <label for="price" class="perso">Prix *:</label>
            <input type="text" name="price" class="form-control" required>
        </div>

        <!-- Champs pour le nom du propriétaire -->
        <div class="form-group">
            <label for="proprio_name" class="perso">Nom du propriétaire:</label>
            <input type="text" name="proprio_name" class="form-control" >
        </div>

        <!-- Champs pour le numéro de téléphone du propriétaire -->
        <div class="form-group">
            <label for="proprio_telephone" class="perso">Numéro de téléphone du propriétaire:</label>
            <input type="text" name="proprio_telephone" class="form-control" >
        </div>

        <!-- Champs pour la description -->
        <div class="form-group">
            <label for="description" class="perso">Description *:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <!-- Champs pour les caractéristiques -->
        <div class="form-group">
            <label class="perso">Caractéristiques *:</label>
            <div class="">
                <label class="form-check-label" for="">Studio: </label>
                <input type="radio" name="type_maison" value="0" class="radio" required>
                <label class="form-check-label" for="">Chambre:</label>
                <input type="radio" name="type_maison" value="1" class="radio" required>
                <label class="form-check-label" for="">Residence:</label>
                <input type="radio" name="type_maison" value="2" class="radio" required>
                <label class="form-check-label" for="">Appartement:</label>
                <input type="radio" name="type_maison" value="3" class="radio" required>
                <label class="form-check-label" for="">MAISON BASSE:</label>
                <input type="radio" name="type_maison" value="4" class="radio" required>
                <label class="form-check-label" for="">DUPLEXE</label>
                <input type="radio" name="type_maison" value="5" class="radio" required><br>

            </div>
            <br>

            <div class="">
                <label class="form-check-label" for="">Habitat haut standing Avec piscine:</label>
                <input type="checkbox" name="has_PISCINE" value="" class="form-check-input">
            </div><br>
        </div>
        <!-- Champs pour le nombre de pièces -->
        <div class="form-group">
            <label for="nombre_piece" class="perso">Nombre de pièces:</label>
            <input type="number" name="nombre_piece" min="1" class="form-control" required>
        </div>

        <!-- Champs pour le nombre de salles d'eau -->
        <div class="form-group">
            <label for="nombre_salle_eau" class="perso">Nombre de salles d'eau:</label>
            <input type="number" name="nombre_salle_eau" min="1" class="form-control" required>
        </div>

            <h5 class="perso">Commodités additionnelles</h5>
            <div class="espace">
                <label class="form-check-label" for="">COUR AVANT </label>

                <input type="checkbox" name="has_COUR_AVANT" class="form-check-input">
            </div>
            <div class="espace">
                <label class="form-check-label" for="">COUR ARRIERE </label>
                <input type="checkbox" name="has_COUR_ARRIERE" class="form-check-input">
            </div>
            <div class="espace">
                <label class="form-check-label" for="">BALCON AVANT </label>
                <input type="checkbox" name="has_balcon_avant" class="form-check-input">
            </div>
            <div class="espace">
                <label class="form-check-label" for="">BALCON ARRIERE </label>
                <input type="checkbox" name="has_balcon_arriere" class="form-check-input">
            </div>
            <div class="espace">
                <label class="text-uppercase" for="">Surveillance avec gardien </label>
                <input type="checkbox" name="has_GARDIEN"  class="form-check-input" >
            </div>
            <div class="espace">
                <label class="text-uppercase" for="">Maison avec Garage </label>
                <input type="checkbox" name="has_GARAGE" class="form-check-input" >

            </div>

            <div class="form-group">
                <label for="photo" class="perso">Photo de façade:</label>
                <input type="file" class="form-control" name="photo_couverture" class="form-control-file" accept="image/*" required>
            </div>
        <!-- Champs pour les images -->

        @for ($i = 1; $i < 10; $i++)
                <div class="form-group">
            <label for="photo-{{ $i }}" class="perso">Photo {{ $i }}:</label>
            <input type="file" class="form-control" name="photo{{ $i }}" class="form-control-file" accept="image/*">

            </div>
        @endfor
            <br>
<!-- Bouton de soumission -->
<button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
</div>
@endsection
