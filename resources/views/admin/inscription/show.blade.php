@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des inscriptions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="#">Detail de l'inscription</a></li>
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
                            <h3>Detail de l'inscription : @if($data->is_validated==1) <font color="green">Profil complet</font> @else <font color="red">Profil incomplet</font>  @endif</h3>
                            <p>
                                Nom complet : {{$data->name}} <br>
                                Lieu de naissance : {{$data->lieu_naissance}}<br>
                                Date de naissance : {{$data->date_naissance}}<br>
                                Sexe : {{$data->genre}}<br>
                                Pays : {{$data->pays}}<br>
                                Nationalité : {{$data->nationalite}}<br>
                                Domicile actuel : {{$data->domicile}}<br>
                                Contacts : {{$data->phone1}}<br>
                                Email : {{$data->user->email}}<br>
                                Role : @if($data->user->is_demarcheur==1) Démarcheur @else User Ebanking @endif<br>
                                Statut inscription : @if($data->is_validated==1) <font color="green">Inscription validée</font>
                                @else <font color="red">Inscription en attente de validation</font> @endif<br>
                                Solde en compte : <font color="green">{{$data->user->balance}} F CFA</font> <br>
                                Pieces d'identité: <br>
                            </p>
                                <div class="d-flex">
                                    <img src="{{asset('assets/img/users/photo')}}/{{$data->photo}}" alt="" width="250px" height="250px">
                                    <img src="{{asset('assets/img/users/pieces')}}/{{$data->cni_recto}}" alt="" width="350px" height="250px">
                                    <img src="{{asset('assets/img/users/pieces')}}/{{$data->cni_verso}}" alt="" width="350px" height="250px">
                                </div>
                            <br>
                            @if($data->is_validated==0)
                            <a href="{{route('inscription.validate',$data->id)}}" class="btn btn-danger">Valider l'inscription</a>
                            <a href="{{route('inscription.validate_with_abonnement',$data->id)}}" class="btn btn-success">Valider avec 1 mois d'abonnement</a>
                            @endif
                                <a href="{{route('inscription.index')}}" class="btn btn-primary">Retourner sur la liste</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
