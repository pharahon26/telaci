@extends('layouts.front_app')
@section('content')
<div class="container">
    <h2>Modifier la maison</h2>
    <h4 class="text-danger">les champs marqués d'une * sont obligatoires</h4><br>
    @include('components.message')
    <form method="post" action="{{route('catalogue.update',$data->ref)}}">
        @csrf
        <!-- Champs pour latitude -->
        <div class="form-group ">
            <label for="latitude" class="perso">Commune:</label>
            <select name="commune_id" required class="form-control" id="">
                @foreach($communes as $item)
                    <option value="{{$item->id}}" @if($item->id == $data->commune_id) selected @endif>{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Champs pour prix -->
        <div class="form-group">
            <label for="price" class="perso">Prix *:</label>
            <input type="text" name="price" value="{{$data->price}}" class="form-control" required>
        </div>

        <!-- Champs pour le nom du propriétaire -->
        <div class="form-group">
            <label for="proprio_name" class="perso">Nom du propriétaire:</label>
            <input type="text" name="proprio_name" value="{{$data->proprio_name}}" class="form-control" >
        </div>

        <!-- Champs pour le numéro de téléphone du propriétaire -->
        <div class="form-group">
            <label for="proprio_telephone" class="perso">Numéro de téléphone du propriétaire:</label>
            <input type="text" name="proprio_telephone" value="{{$data->proprio_telephone}}" class="form-control" >
        </div>

        <!-- Champs pour la description -->
        <div class="form-group">
            <label for="description" class="perso">Description *:</label>
            <textarea name="description" value="" class="form-control" required>{{$data->description}}</textarea>
        </div>

        <!-- Champs pour les caractéristiques -->
        <div class="form-group">
            <label class="perso">Caractéristiques *:</label>
            <div class="">
                <label class="form-check-label" for="">Studio: </label>
                <input type="radio" name="type_maison" @if($data->is_Studio==1) checked @endif value="0" class="radio" required>
                <label class="form-check-label" for="">Chambre:</label>
                <input type="radio" name="type_maison" @if($data->is_Chambre==1) checked @endif value="1" class="radio" required>
                <label class="form-check-label" for="">Residence:</label>
                <input type="radio" name="type_maison" @if($data->is_Residence==1) checked @endif value="2" class="radio" required>
                <label class="form-check-label" for="">Appartement:</label>
                <input type="radio" name="type_maison" @if($data->is_Appartment==1) checked @endif value="3" class="radio" required>
                <label class="form-check-label" for="">MAISON BASSE:</label>
                <input type="radio" name="type_maison" @if($data->is_MAISON_BASSE==1) checked @endif value="4" class="radio" required>
                <label class="form-check-label" for="">DUPLEXE</label>
                <input type="radio" name="type_maison" @if($data->is_DUPLEX==1) checked @endif value="5" class="radio" required><br>

            </div>
            <br>

            <div class="">
                <label class="form-check-label" for="">Maison haut standing :</label>
                <input type="checkbox" name="is_HAUT_STANDING" @if($data->is_HAUT_STANDING==1) checked @endif class="form-check-input">
            </div><br>
            <div class="">
                Maison Avec piscine <input type="radio" name="has_PISCINE" @if($data->has_PISCINE==1) checked @endif value="1" class="form-check-input" required>
                Maison Sans piscine <input type="radio" name="has_PISCINE" @if($data->has_PISCINE==0) checked @endif value="0" class="form-check-input" required>
            </div><br>
        </div>
        <!-- Champs pour le nombre de pièces -->
        <div class="form-group">
            <label for="nombre_piece" class="perso">Nombre de pièces:</label>
            <input type="number" name="nombre_piece" min="1" value="{{$data->nombre_piece}}" class="form-control" required>
        </div>

        <!-- Champs pour le nombre de salles d'eau -->
        <div class="form-group">
            <label for="nombre_salle_eau" class="perso">Nombre de salles d'eau:</label>
            <input type="number" name="nombre_salle_eau" min="1" value="{{$data->nombre_salle_eau}}" class="form-control" required>
        </div>

            <h5 class="perso">Commodités additionnelles</h5>
            <div class="espace">
                <label class="form-check-label" for="">COUR AVANT </label>

                <input type="checkbox" name="has_COUR_AVANT" @if($data->has_COUR_AVANT==1) checked @endif class="form-check-input">
            </div>
            <div class="espace">
                <label class="form-check-label" for="">COUR ARRIERE </label>
                <input type="checkbox" name="has_COUR_ARRIERE" @if($data->has_COUR_ARRIERE==1) checked @endif class="form-check-input">
            </div>
            <div class="espace">
                <label class="form-check-label" for="">BALCON AVANT </label>
                <input type="checkbox" name="has_balcon_avant" @if($data->has_balcon_avant==1) checked @endif class="form-check-input">
            </div>
            <div class="espace">
                <label class="form-check-label" for="">BALCON ARRIERE </label>
                <input type="checkbox" name="has_balcon_arriere" @if($data->has_balcon_arriere==1) checked @endif class="form-check-input">
            </div>
            <div class="espace">
                <label class="text-uppercase" for="">Surveillance avec gardien </label>
                <input type="checkbox" name="has_GARDIEN" @if($data->has_GARDIEN==1) checked @endif class="form-check-input" >
            </div>
            <div class="espace">
                <label class="text-uppercase" for="">Maison avec Garage </label>
                <input type="checkbox" name="has_GARAGE" @if($data->has_GARAGE==1) checked @endif class="form-check-input" >

            </div>
            <br>
<!-- Bouton de soumission -->
<button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
</div>
@endsection
