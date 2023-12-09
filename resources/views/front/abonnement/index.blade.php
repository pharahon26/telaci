@extends('layouts.front_app')
@section('content')

<div class="container">
    <div >
        <h3 class="text-white">Les tarifs d'abonnements</h3>
        <div class="row">
            @foreach($datasAbonnements as $data)
            <div class="col-4">
                    <div class="card text-center">
                        <h4 class="text-danger">{{$data->price}} F CFA</h4>
                        <h5>{{$data->title}}</h5>
                        <h5>{{$data->pourcentage_demarcheur}}%</h5>
                        <h5>Gain du demarcheur: {{(($data->price *$data->pourcentage_demarcheur)/100)}}F CFA</h5>
                        <a href="{{route('abonnement.show_suscribe_form',$data->id)}}" class="btn btn-primary">Souscrire</a>

                    </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
@endsection
