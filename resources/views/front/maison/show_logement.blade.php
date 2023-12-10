@extends('layouts.front_app')
@section('content')

<div class="container">
    <div class="text-black">
        <h3>Nombre de visite restant: {{$restevisite}}</h3>
        <h3>Detail de la maison</h3>
            <div class="row">
                <img src="{{asset($data->photo_couverture)}}" height="250px" alt=""><br>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="couleur_perso"> {{$data->price}} F CFA <br>
                        {{$data->commune->name}} {{$data->nombre_piece}} pieces<br></h2>
                    <h2 class="couleur_perso"> {{$data->user->name}} - {{$data->user->phone}} <br></h2>
                </div>
                <div class="col-12 text-black">
                    Commodités : @if($data->has_COUR_AVANT==1) Cour avant; @endif
                    @if($data->has_COUR_ARRIERE==1) Cour arriere; @endif
                    @if($data->has_GARDIEN==1) Gardien; @endif
                    @if($data->has_GARAGE==1) Garage; @endif
                    @if($data->has_balcon_avant==1) Balcon avant; @endif
                    @if($data->has_balcon_arriere==1) Balcon arriere @endif <br>
                </div>


                @foreach($images as $item)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <img src="{{asset($item->url)}}" class="img-places" alt="">
                    </div>
                @endforeach
            </div>
    </div>
</div>
@endsection
