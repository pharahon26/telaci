@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des catégories de programmes tela tv</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="{{route('categorie_programme_tv.list')}}">Liste des catégories de programmes</a></li>
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
                            <a href="{{route('categorie_programme_tv.create')}}" class="btn btn-primary">Ajouter une catégorie d'émission</a>
                        @if($datas->count()>0)
                            <!-- Button trigger modal -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Catégorie</th>
                                        <th>Image</th>
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
                                            <td>{{$data->name}}</td>
                                            <td><img src="{{asset('assets/img/categorie_emission')}}/{{$data->picture}}" alt="" width="50px" height="50px"> </td>
                                            <td>@if($data->created_at!=null) {{$data->created_at->format('d-m-Y')}} @else NEANT @endif</td>
                                            @if(auth()->user()->is_staff==1)
                                                <td>

                                                    <a href="#" class="btn btn-warning btn-xs">Modifier</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h5 class="text-center">Aucun catégorie d'émission enregistrée pour le moment</h5>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
