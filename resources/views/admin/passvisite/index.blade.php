@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des pass visite</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="{{route('pass_visite.index')}}">Liste des pass visite</a></li>
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
                                        <th>Type de passe</th>
                                        <th>Code</th>
                                        <th>Date expiration</th>
                                        <th>Nombre de visite</th>
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
                                            <td>{{$data->passType->name}} <br>
                                                {{$data->passType->price}} F
                                            </td>
                                            <td>{{$data->code}}</td>
                                            <td>{{$data->end_date}}</td>
                                            <td>{{$data->nb_visite}}</td>
                                            <td>{{$data->transaction->transaction_number}}</td>
                                            <td>@if($data->is_expired==0) <font color="green">Actif</font> @else <font color="red">Expiré</font> @endif</td>
                                            <td>@if($data->created_at!=null) {{$data->created_at->format('d-m-Y')}} @else NEANT @endif</td>
                                            @if(auth()->user()->is_staff==1)
                                                <td>
{{--                                                    <a href="{{route('pass_visite.show',$data->id)}}" class="btn btn-warning btn-xs">Detail</a>--}}

                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#validateModal{{$data->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <!-- Modal -->

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h5 class="text-center">Aucun pass visite enregistré pour le moment</h5>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
