@extends('layouts.front_app')
@section('content')

<div class="container">
    <div class="text-black">
        <h3>Resultat de votre recherche</h3>
        @if($data_search->count()>0)
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered text-black">
<!--                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Type de maison</th>
                            <th>Prix</th>
                            <th>Commune</th>
                            <th>Commodités</th>
                            <th>Actions</th>
                        </tr>
                        </thead>-->
                        <tbody>
                        @foreach($data_search as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->nombre_piece}} piece(s)</td>
                                <td>{{$data->price}}F</td>
                                <td>{{$data->commune->name}}</td>

                                <td>
                                    <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Consulter les photos du logement
                                    </button>
                                </td>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-success" id="exampleModalLabel">Confirmation de la consultation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="text-danger">La consultation de cette maison diminuera votre passe visite d'un (1) point.</h5>
                                                <h6>Veuillez saisir votre code</h6>
                                                <form action="{{route('maison.show.logement',$data->ref)}}" method="get">
                                                    @csrf
                                                    <input type="text" name="code" required value="{{$cookiePassVisite}}" class="form-control"> <br>
{{--                                                    <input type="hidden" name="ref" value="{{$data->ref}}">--}}
                                                    <button type="submit" class="btn btn-success">Consulter les photos</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la fenetre</button>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
{{--                                                <a href="{{route('maison.show.logement',$data->ref)}}" class="btn btn-success">Consulter les photos</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
        <h4>Aucun logement ne correspond à vos critères de recherche</h4>
        @endif
    </div>
    <br><br>


</div>
@endsection
