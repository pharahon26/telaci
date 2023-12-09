@extends('layouts.front_app')
@section('content')

<div class="container">
    <div >
        <h3 class="text-white">Notification de votre achat de pass visite</h3>
        <div class="row">
            <h5 class="text-danger">
                Votre code est {{$cookiePassVisite}}<br>
                Veuillez bien le conserver pour vos prochaines consultations de logement sur notre
                site web.
            </h5>
        </div>
    </div>

</div>
@endsection
