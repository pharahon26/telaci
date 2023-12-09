@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion du compte</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="#">Accueil</a></li>**
                        <li class="">Edition du mot de passe</li>
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
                        <div class="card-body d-flex">
                            <div class="col-12">
                                <form class="" action="{{route('account.update')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <h5 class="col-12">Modifier les informations de mon mot de passe</h5><br>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="" for="input1">Mot de passe<span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="password"  placeholder="" type="password" required value="{{$data->token}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="" for="input1">Confirmer du mot de passe<span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="password_confirmation"  placeholder="" type="password" required value="{{$data->token}}">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                                        <a href="{{route('home')}}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
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
