@extends('layouts.front_app')
@section('content')

    <div class="container">
        <div class="row">
            <h3>Mes informations personnelles</h3>
            <h4 class="text-uppercase text-black">Bienvenue {{auth()->user()->name}}</h4>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-12">
                <p>Date de naissance: {{$data->date_naissance}}</p>
                <p>Lieu de naissance: {{$data->lieu_naissance}}</p>
                <p>Lieu de residence: {{$data->domicile}}</p>
                <p>Nationalité: {{$data->nationalite}}</p>
                <p>Numero de piece: {{$data->numero_cni}}</p>
                <p>Contact principal: {{$data->phone1}}</p>
                <p>Contact secondaire: {{$data->phone2}}</p>
                <p>Statut de votre profil: @if(auth()->user()->is_completed==0) incomplet @else complet @endif</p>
                <p>Statut de votre inscription : @if($data->is_validated==0) En attente de validation @else Validé @endif</p>

            </div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-12">
                <img src="{{asset($data->photo)}}" width="250px" height="250px" alt="">
            </div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-12">
                <img src="{{asset($data->cni_recto)}}" width="250px" height="250px" alt="">
            </div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-12">
                <img src="{{asset($data->cni_verso)}}" width="250px" height="250px" alt="">
            </div>
        </div>


    </div>
@endsection
