@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="col-12">
                                <form class="" action="{{route('programmes_tv.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <h5 class="col-12">Enregistrer une emission</h5><br>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label class="" for="input1">Titre <span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="nom"  placeholder="" type="text" required value="{{old('nom')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label class="" for="input1">Catégorie <span class="contact__form--label__star">*</span></label>
                                                <select name="categorie_programme_tv_id" class="form-control" id="" required>
                                                    @foreach($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label class="" for="input1">Choisir la vidéo <span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="link"  placeholder="" type="file" required >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="" for="input1">Date de tournage<span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="date_tournage"  placeholder="" type="date" required value="{{old('date_tournage')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="" for="input1">Date de diffusion<span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="date_diffusion"  placeholder="" type="date" required value="{{old('date_diffusion')}}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="" for="input1">Description<span class="contact__form--label__star">*</span></label>
                                                <textarea name="description" required class="form-control" id="" cols="30" rows="3">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Enregistrer</button>
                                        <a href="{{route('programmes_tv.index')}}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
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
