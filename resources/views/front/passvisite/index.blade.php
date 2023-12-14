@extends('layouts.front_app')
@section('content')

<div class="container">
    <div >
        <h3 class="text-black text-center">Les tarifs des pass visite</h3>
        <div class="row">
            @include('components.message') <br>

            @foreach($datas as $data)
            <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                    <div class="card text-center">
                        <h4 class="text-danger">{{$data->price}} F CFA</h4>
                        <h5>{{$data->name}}</h5>
                        <h5>Nombre de visite: {{$data->nb_visite}}</h5>
                        <a href="{{route('passvisite.showbuy',$data->id)}}" class="btn btn-primary">Souscrire</a>
                    </div>
                <br>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
