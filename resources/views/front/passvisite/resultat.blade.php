@extends('layouts.front_app')
@section('content')

<div class="container">
    <div >
        <h3 class="text-white">Notification de votre pass visite</h3>
        <div class="row">
            @if($check!=null)

            <h5>Détail du pass visite {{$check->code}}</h5>
                Type de pass: {{$check->passType->name}} <br>
                Tarif du pass: {{$check->passType->price}} F CFA <br>
                Date de souscription: {{$check->created_at}}<br>
                Date d'expiration: {{$check->end_date}}<br>
                Nombre de visite restant: {{$check->nb_visite}}<br>
                <div class="col-4"></div>
                <div class="col-4">
                    <a href="{{route('passvisite.index')}}" class="btn btn-warning">POLONGER / RECONDUIRE MON PASS</a>
                </div>
                <div class="col-4"></div>
            @else
            <h5 class="text-center text-danger">Ce code ne correspond à aucun pass visite dans notre base de données.
                <br>
                Veuillez saisir un code valide ou acheter un nouveau pass</h5> <br><br>
                @foreach($datas as $data)
                    <div class="col-4">
                        <div class="card text-center">
                            <h4 class="text-danger">{{$data->price}} F CFA</h4>
                            <h5>{{$data->name}}</h5>
                            <h5>Nombre de visite: {{$data->nb_visite}}</h5>
                            <a href="{{route('passvisite.showbuy',$data->id)}}" class="btn btn-primary">Souscrire</a>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
    </div>

</div>
@endsection
