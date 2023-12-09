@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des catégorie de programmes tela tv</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="{{route('categorie_programme_tv.list')}}">Liste des catégorie d'émission</a></li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="col-12">
                                <form class="" action="{{route('categorie_programme_tv.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <h5 class="col-12">Enregistrer une catégorie d'emission</h5><br>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="" for="input1">Titre <span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="name"  placeholder="" type="text" required value="{{old('name')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="" for="input1">Choisir la photo <span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="picture"  placeholder="" type="file" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Enregistrer</button>
                                        <a href="{{route('categorie_programme_tv.list')}}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
