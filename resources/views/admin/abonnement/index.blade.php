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
                        <li class=""><a href="{{route('abonnement.index')}}">Liste des abonnements</a></li>
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
                        @if($datas->count()>0)
                            <!-- Button trigger modal -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Demarcheur</th>
                                        <th>Type d'abonnement</th>
                                        <th>Gain demarcheur</th>
                                        <th>Date debut</th>
                                        <th>Date expiration</th>
                                        <th>Ref Transaction</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        @if(auth()->user()->is_staff==1)
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->user->name}} <br>
                                                {{$data->user->phone}}
                                            </td>
                                            <td>{{$data->typeAbonnement->title}}
                                                <br>
                                                {{$data->typeAbonnement->price}}F
                                            </td>
                                            <td>{{(($data->typeAbonnement->price* $data->typeAbonnement->pourcentage_demarcheur)/100)}}F CFA</td>
                                            <td>{{$data->start_date}}</td>
                                            <td>{{$data->end_date}}</td>
                                            <td>{{$data->transaction->transaction_number}}</td>
                                            <td>@if($data->is_actif==1) <font color="green">Actif</font> @else <font color="red">Inactif</font> @endif</td>
                                            <td>@if($data->created_at!=null) {{$data->created_at->format('d-m-Y')}} @else NEANT @endif</td>
                                            @if(auth()->user()->is_staff==1)
                                                <td>
                                                    <a href="{{route('abonnement.show',$data->id)}}" class="btn btn-warning btn-xs">Detail</a>

                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#validateModal{{$data->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="validateModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de la suppression</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Cette action est irreversible. <br>
                                                                    Voulez vous supprimer l'abonnement de {{ $data->user->name }} ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                                                                    <a href="#" class="btn btn-icon btn-success sendLink"><i class="fas fa-times"></i>Confirmer la suppression</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--end modale --}}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h5 class="text-center">Aucun abonnement enregistré pour le moment</h5>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
