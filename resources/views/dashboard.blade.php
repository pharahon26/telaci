@extends('layouts.admin_app')

@section('content')
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
      @if(auth()->user()->is_staff==1)
          <section class="content">
              <div class="container-fluid">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">
                                  <h3>{{$nbinscriptions}}</h3>
                                  <p>GESTION DES INSCRIPTIONS</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-user"></i>
                              </div>
                              <a href="{{route('inscription.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                              <div class="inner">
                                  <h3>{{$nbmaisons}}</h3>
                                  <p>GESTION DES MAISONS</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-home"></i>
                              </div>
                              <a href="{{route('maison.index')}}" class="small-box-footer">Afficher les maisons <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">
                                  <h3>{{$nbprogrammes}}</h3>
                                  <p>GESTION DES PROGRAMMES</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-tablet"></i>
                              </div>
                              <a href="{{route('programmes_tv.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                              <div class="inner">
                                  <h3>{{$nbabonnements}}</h3>
                                  <p>GESTION DES ABONNEMENTS</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-campground"></i>
                              </div>
                              <a href="{{route('abonnement.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>

                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">
                                  <h3>{{$nbpassvisites}}</h3>
                                  <p>GESTION DES PASS VISITE</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-home"></i>
                              </div>
                              <a href="{{route('pass_visite.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                              <div class="inner">
                                  <h3>{{$nbpasstvs}}</h3>
                                  <p>GESTION DES PASS TV</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-table"></i>
                              </div>
                              <a href="{{route('pass_tv.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">
                                  <h3>{{$nbtransactions}}</h3>
                                  <p>GESTION DES TRANSACTIONS</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-euro-sign"></i>
                              </div>
                              <a href="{{route('transactions.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                              <div class="inner">
                                  <h3>{{$nbtypeabonnements}}</h3>
                                  <p>GESTION TYPES D'ABONNEMENT</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-cog"></i>
                              </div>
                              <a href="{{route('type_abonnement.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>

                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">
                                  <h3>{{$nbtypepass}}</h3>
                                  <p>GESTION DES TYPE DE PASS</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-cogs"></i>
                              </div>
                              <a href="{{route('type_pass.index')}}" class="small-box-footer">Afficher la liste <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                              <div class="inner">
                                  <h3>{{$nbusers}}</h3>
                                  <p>GESTION DES UTILISATEURS</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-users"></i>
                              </div>
                              <a href="" class="small-box-footer">Afficher la liste<i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">
                                  <h3>{{$nbcategorieemissions}}</h3>
                                  <p>GESTION DES CATEGORIE D'EMISSION</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-caravan"></i>
                              </div>
                              <a href="{{route('categorie_programme_tv.list')}}" class="small-box-footer">Afficher la liste<i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-primary">
                              <div class="inner">
                                  <h3>{{$nblistediffusion}}</h3>
                                  <p>GESTION DES LISTE DE DIFFUSION</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-caravan"></i>
                              </div>
                              <a href="{{route('liste_diffusion.list',$date)}}" class="small-box-footer">Afficher la liste<i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>


                  </div>

              </div><!-- /.container-fluid -->
          </section>
      @else

      @endif

  <!-- /.content-wrapper -->
@endsection
