@extends('layouts.front_app')
@section('content')

<div class="container">
    <div class="options-container">
        <h3>Maison à louer</h3>
        <a href="{{route('maison.show_form_logement')}}" class="location-button">Logement</a>
        <a href="{{route('maison.show_form_bureau')}}" class="location-button">Bureau</a>

    </div>


</div>
@endsection