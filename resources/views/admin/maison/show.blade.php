@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des maisons</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="#">Detail de la maison</a></li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Detail de la maison</h3>
                            <div class="d-flex">
                                <div class="col-6">
                                    <p>
                                        Nom du propriétaire : {{$data->proprio_name}} <br>
                                        Contacts du propriétaire : {{$data->proprio_telephone}}<br>
                                        Nombre de piece :{{$data->nombre_piece}} <br>
                                        Prix : {{$data->price}} F<br>
                                        Etat de la maison : @if($data->is_occupe==0) <font color="green"> Libre</font> @else <font color="red">Ocuppée </font>@endif<br>
                                        Statut de la maison : @if($data->is_validated==0) <font color="red">En attente de validation</font> @else <font color="green">Validée</font> @endif<br>
                                        Commune : {{$data->commune->name}}<br>
                                        Nom du demarcheur : {{$data->user->name}}<br>
                                        Contact du demarcheur : {{$data->user->phone}}<br>
                                        Type de maison :
                                        @if($data->is_Studio==1) Studio @endif
                                        @if($data->is_Chambre==1) Chambre @endif
                                        @if($data->is_Appartment==1) Appartement @endif
                                        @if($data->is_MAISON_BASSE==1) MAISON BASSE @endif
                                        @if($data->is_DUPLEX==1) DUPLEXE @endif
                                        <br>
                                        Commodités additionnelles :
                                        @if($data->has_PISCINE==1) PISCINE @endif,
                                        @if($data->is_HAUT_STANDING==1) HAUT STANDING @endif,
                                        @if($data->has_COUR_AVANT==1) COUR AVANT @endif,
                                        @if($data->has_COUR_ARRIERE==1) COUR ARRIERE @endif,
                                        @if($data->has_GARDIEN==1) GARDIEN @endif,
                                        @if($data->has_GARAGE==1) GARAGE @endif,
                                        @if($data->has_balcon_avant==1) Balcon avant @endif,
                                        @if($data->has_balcon_arriere==1) Balcon arriere @endif <br>
                                        Nombre de salle d'eau: {{$data->nombre_salle_eau}}
<br>
                                    </p>
                                </div>
                            </div>

                                <div class="container">
                                    <div class="row">
                                        @if($data_images->count()>0)
                                            @foreach($data_images as $item)
                                                <div class="col-3">
                                                    <img src="{{asset($item->url)}}" alt="" width="250px" height="250px">
                                                </div>
                                            @endforeach
                                        @else
                                        <h3 class="text-danger text-center">Aucune photo disponible pour cette maison</h3>
                                        @endif

                                    </div>
                                </div>
                            <br>
                            @if($data->is_validated==0)
                            <a href="{{route('maison.validate',$data->id)}}" class="btn btn-success">Valider les informations de la maison</a>
                            @endif
                            <a href="{{route('maison.occupe',$data->id)}}" class="btn btn-danger">Mettre la maison occupée</a>

                            <a href="{{route('maison.index')}}" class="btn btn-primary">Retourner sur la liste</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
