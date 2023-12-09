@extends('layouts.front_app')
@section('content')

<div class="container">
    <div class="text-black">
        @auth
        <h3>Mon compte</h3>
            <h5>Mon solde: {{$datas->balance}} F CFA</h5>
        @else
        <h4>Veuillez vous connecter pour accéder à votre compte TELA FINANCE</h4>
        @endauth
    </div>

</div>
@endsection
