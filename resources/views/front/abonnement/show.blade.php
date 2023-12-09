@extends('layouts.front_app')
@section('content')

<div class="container">
    <div >
        <h3 class="text-black">Mes abonnements</h3>
        <div class="row">
            @if($datas->count()>0)
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered text-black">

                            @foreach($datas as $data)
                                <tr>
                                    <td>Pass {{$data->typeAbonnement->title}} {{$data->typeAbonnement->price}}F</td>
                                    <td>Mon gain: {{(($data->typeAbonnement->price* $data->typeAbonnement->pourcentage_demarcheur)/100)}}F CFA</td>
                                    <td>
                                        Date d'abonnement:
                                        {{ $data->start_date}}
                                    </td>
                                    <td>
                                        Date d'expiration:
                                        {{$data->end_date}}
                                    </td>
                                    <td>@if($data->is_actif==1) <font color="green">Actif</font> @else <font color="red">Inactif</font> @endif</td>
                                </tr>
                                @endforeach

                        </table>
                    </div>
                </div>
            @else
                <h4>Vous n'avez souscrire à aucun abonnement</h4><br>
                <div class="col-4"></div>
                <div class="col-4">
                    <a href="{{route('abonnement.show_form')}}" class="btn btn-warning btn-lg">Souscrire maintenant à un abonnement</a>
                </div>
                <div class="col-4"></div>
            @endif
        </div>
    </div>


</div>
@endsection
