@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des programmes tela tv</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="{{route('programmes_tv.index')}}">Liste des programmes</a></li>
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
                            <a href="{{route('programmes_tv.create')}}" class="btn btn-primary">Ajouter un programme</a>
                        @if($datas->count()>0)
                            <!-- Button trigger modal -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Date tournage</th>
                                        <th>Date diffusion</th>
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
                                            <td>{{$data->nom}}</td>
                                            <td>
                                                @if($data->categorie_programme_tv_id==1) Publicité
                                                @elseif($data->categorie_programme_tv_id==2) Emission live
                                                @elseif($data->categorie_programme_tv_id==3) Emission différée
                                                @elseif($data->categorie_programme_tv_id==4) Rédiffusion
                                                @elseif($data->categorie_programme_tv_id==5) Sport
                                                @else Music & film
                                                @endif

                                            </td>
                                            <td>{{$data->date_tournage}}</td>
                                            <td>{{$data->date_diffusion}}</td>
                                            <td>@if($data->created_at!=null) {{$data->created_at->format('d-m-Y')}} @else NEANT @endif</td>
                                            @if(auth()->user()->is_staff==1)
                                                <td>

                                                    <a href="#" class="btn btn-warning btn-xs">Modifier</a>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#validateModal{{$data->id}}">
                                                        <i class="fa fa-eye"></i> Voir
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="validateModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Visualisation de la vidéo</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <video controls height="300px" width="100%">
                                                                            <source src="{{asset('assets/videos')}}/{{$data->link}}" type="video/mp4">
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button>
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
                                <h5 class="text-center">Aucun programme enregistré pour le moment</h5>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
