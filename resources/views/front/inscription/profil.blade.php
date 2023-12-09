@extends('layouts.front_app')
@section('content')

    <div class="container">
        <div>
            <h3>Mon profil</h3>
            <h4 class="text-uppercase text-black">Bienvenue {{auth()->user()->name}}</h4>
            @if(auth()->user()->is_completed==0)
                <p class="text-black">
                    Votre profil n'est pas complet. <a href="{{route('profil.edit',auth()->user()->id)}}" class="btn btn-warning">Cliquez  ici pour le completer</a>
                </p>
            @else
                @if($abonnements->count()>0)

                @else
                    <h5 class="text-danger">Vous n'avez pas encore souscrire à un abonnement</h5>
                @endif
                <a href="{{route('catalogue.index')}}" class="btn btn-primary btn-lg">Acceder à mon catalogue</a>
                <a href="{{route('profil.show',auth()->user()->id)}}" class="btn btn-info btn-lg">Voir mes informations</a>
                <a href="{{route('abonnement.show_form')}}" class="btn btn-warning btn-lg">Souscrire à un abonnement</a>
                <a href="{{route('abonnement.list',auth()->user()->id)}}" class="btn btn-warning btn-lg">Consulter mes abonnements</a>
            @endif
        </div>


    </div>
@endsection
