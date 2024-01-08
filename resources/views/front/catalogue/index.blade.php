@extends('layouts.front_app')
@section('content')

    <div class="container">
        <div class="text-black">
            <h3>Mon catalogue</h3>
            @if(\Illuminate\Support\Facades\Auth::user()->is_suspended==0)
                <a href="{{route('catalogue.create')}}" class="btn btn-primary">Ajouter une maison</a><br>
            @else
                <p class="text-danger"> Votre abonnement a expiré.</p> <a href="{{route('abonnement.show_form')}}" class="btn btn-secondary">Veuillez vous réabonner</a>
            @endif
            <br>
            @include('components.message')
            @if($datas->count()>0)
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered text-black">
                            <!--                        <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Type de maison</th>
                                                        <th>Prix</th>
                                                        <th>Etat</th>
                                                        <th>Statut</th>
                                                        <th>Commune</th>
                                                        <th>Proprietaire</th>
                                                        <th>Date</th>

                                                        <th>Actions</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>-->
                            @foreach($datas as $data)
                                <tr>
                                    {{--                                <td>{{$data->id}}</td>--}}

                                    <td>
                                        @if($data->is_Studio==1) Studio @endif
                                        @if($data->is_Chambre==1) Chambre @endif
                                        @if($data->is_Residence==1) Residence @endif
                                        @if($data->is_Appartment==1) Appartement @endif
                                        @if($data->is_Appartment==1) Appartement @endif
                                        @if($data->is_MAISON_BASSE==1) Maison basse @endif
                                        @if($data->is_DUPLEX==1) Duplexe @endif
                                            <br>
                                        @if($data->is_HAUT_STANDING==1) Haut standing @endif <br>
                                        @if($data->has_PISCINE==1) Avec piscine @endif
                                        <br>
                                        {{$data->nombre_piece}} piece(s)
                                    </td>
                                    <td>{{$data->price}}F</td>
                                    <td>@if($data->is_occupe==0) <font color="green">Libre</font> @else <font color="red">Ocuppée</font> @endif</td>
                                    <td>@if($data->is_validated==0) <font color="red">En attente de validation</font> @else <font color="green">Validée</font> @endif</td>
                                    <td>{{$data->commune->name}}</td>
                                    <td>{{$data->proprio_name}} <br>
                                        {{$data->proprio_telephone}}
                                    </td>
                                    <td>@if($data->created_at!=null) {{$data->created_at->format('d-m-Y')}} @else NEANT @endif</td>


                                    <td>
                                        <a href="{{route('catalogue.show',$data->ref)}}" class="btn btn-primary">Detail</a>
                                        <a href="{{route('catalogue.edit',$data->ref)}}" class="btn btn-success">Modifier</a>
                                        <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModale">
                                            Supprimer
                                        </button>

                                        <a href="{{route('catalogue.editpicture',$data->ref)}}" class="btn btn-secondary">Modifier les photos</a>
                                        <br>
                                        <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Definir comme occupée
                                        </button>
                                    </td>
                                    {{--   modale statut--}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-success" id="exampleModalLabel">Changement de statut</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="text-danger">Attention vous etes sur le point
                                                        de changer le statut de la maison</h5>
                                                    <h6>Statut actuel de la maison: @if($data->is_occupe==0) Libre @else Occupée @endif</h6>
                                                    <form action="{{route('catalogue.edit_statut',$data->ref)}}" method="get">
                                                        @csrf
                                                        <label for="">Nouveau statut:</label>
                                                        Occupée <input type="radio" name="is_occupe" required value="1" >
                                                        Libre <input type="radio" name="is_occupe" required value="0" > <br>
                                                        <button type="submit" class="btn btn-primary">Valider</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la fenetre</button>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    {{--                                                <a href="{{route('maison.show.logement',$data->ref)}}" class="btn btn-success">Consulter les photos</a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--   end modale statut--}}

                                    {{--   modale suppression--}}
                                    <div class="modal fade" id="exampleModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-success" id="exampleModalLabel">Changement de statut</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="text-danger">Attention vous etes sur le point de supprimer la maison</h5>
                                                    <h6>Cette action est irrverssible <br>
                                                    Voulez vous supprimer la maison ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('catalogue.delete',$data->id)}}" class="btn btn-success">Confirmer la suppression</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--   end modale suppression--}}
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h4>Votre catalogue est vide</h4>
            @endif
        </div>

    </div>
@endsection
