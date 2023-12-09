@extends('layouts.front_app')
@section('content')

<div class="container">
    <div class="text-black">
        <h3>Nombre de visite restant: {{$restevisite}}</h3>
        <h3>Detail de la maison</h3>
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 text-black">
                 Type de maison : {{$data->nombre_piece}} pieces<br>
                 Prix : {{$data->price}} F CFA <br>
                 Commune: {{$data->commune->name}} <br>
                 Demarcheur: {{$data->user->name}} / {{$data->user->phone}}<br>
                 Commodités : @if($data->has_COUR_AVANT==1) *Cour avant @endif <br>
                    @if($data->has_COUR_ARRIERE==1) *Cour arriere @endif <br>
                    @if($data->has_GARDIEN==1) *Avec gardien @endif <br>
                    @if($data->has_GARAGE==1) *Avec garage @endif <br>
                    @if($data->has_balcon_avant==1) *Avec balcon avant @endif <br>
                    @if($data->has_balcon_arriere==1) *Avec balcon arriere @endif <br>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <img src="{{asset('assets/img/places')}}/{{$data->photo_couverture}}" height="250px" alt="">
                    <br><br></div>

                @foreach($images as $item)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <img src="{{asset('assets/img/places')}}/{{$item->url}}" class="img-places" alt="">
                    </div>
                @endforeach
            </div>
    </div>
</div>
@endsection
