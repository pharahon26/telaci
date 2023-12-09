@extends('layouts.front_app')
@section('content')

<div class="container">
    <div class="text-black">
        <h3>Resultat de votre recherche</h3>
        @if($data_search->count()>0)
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
<!--                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Type de bureau</th>
                            <th>Prix</th>
                            <th>Commune</th>
                            <th>Commodités</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>-->
                        @foreach($data_search as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->nombre_piece}} piece(s)</td>
                                <td>{{$data->price}}F</td>
                                <td>{{$data->commune->name}}</td>
                                <td>
                                    @if($data->has_COUR_AVANT==1) *Cour avant @endif <br>
                                    @if($data->has_COUR_ARRIERE==1) *Cour arriere @endif <br>
                                    @if($data->has_GARDIEN==1) *Avec gardien @endif <br>
                                    @if($data->has_GARAGE==1) *Avec garage @endif <br>
                                    @if($data->has_balcon_avant==1) *Avec balcon avant @endif <br>
                                    @if($data->has_balcon_arriere==1) *Avec balcon arriere @endif <br>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Consulter les photos du bureau
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
                                                <h5 class="text-danger">La consultation de ce bureau diminuera votre passe visite d'un (1) point.</h5>
                                                <h6>Veuillez saisir votre code</h6>
                                                <form action="{{route('maison.show.bureau',$data->ref)}}" method="get">
                                                    @csrf
                                                    <input type="text" name="code" required value="{{$cookiePassVisite}}" class="form-control"> <br>
                                                    {{--                                                    <input type="hidden" name="ref" value="{{$data->ref}}">--}}
                                                    <button type="submit" class="btn btn-success">Consulter les photos</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la fenetre</button>

                                                </form>

                                            </div>
                                            <div class="modal-footer">
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
        <h4>Aucun bureau ne correspond à vos critères de recherche</h4>
        @endif
    </div>

</div>
@endsection
