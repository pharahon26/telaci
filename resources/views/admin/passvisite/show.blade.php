@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des abonnements</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="#">Detail de l'abonnement</a></li>
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
                            <h3>Detail de l'abonnement</h3>
                            <div class="d-flex">
                                <div class="col-6">
                                    <p>
                                        Nom du demarcheur : {{$data->user->name}}<br>
                                        Contact du demarcheur : {{$data->user->phone}}<br>
                                        Type d'abonnement : {{$data->typeAbonnement->title}} <br>
                                        Montant de l'abonnement : {{$data->typeAbonnement->price}} F CFA <br>
                                        Pourcentage du demarcheur :{{$data->typeAbonnement->pourcentage_demarcheur}} %<br>
                                        Gain du demarcheur :{{(($data->typeAbonnement->price* $data->typeAbonnement->pourcentage_demarcheur)/100)}}F CFA <br>
                                        Date de debut :{{$data->start_date}} <br>
                                        Date de fin :{{$data->end_date}} <br>
                                        Date d'abonnement :{{$data->created_at}} <br>
                                        Numero de transaction :{{$data->transaction->transaction_number}} <br>
                                        Statut de l'abonnement : @if($data->is_actif==0) <font color="red">Inactif</font> @else <font color="green">Actif</font> @endif<br>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
