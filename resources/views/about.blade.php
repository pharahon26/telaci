@extends('layouts.front_app')
@section('content')
            <div>
                <p class="text-black text-justify"> <font size="+1">
                    Dans le souci de participer activement au développement de notre pays et surtout faciliter la vie aux populations, nous n'avons de cesse de réflechir et apporter notre contribution pour impacter positivement la vie de chaque citoyen vivant sur le sol d'Eburnie.
                    C'est dans cette optique que nous vous proposons la plateforme TELA. TELA est une application tout en un qui a été mise en place dans le but de faciliter la vie aux populations vivant en Côte d'Ivoire.
                    <br><br>
                    Premièrement, avec Tela, désormais c'est facile de trouver rapidement un logement à son gout. Pour y arriver, il suffit de cliquer dans la rubrique “Maison à louer” pour trouver le logement de son choix.
                    De plus c'est une application qui va générer à terme plus de 30 000 emplois sur toute l'étendue du territoire ivoirien.
                    A ce niveau il s'agit pur le citoyen lambda de transférer des photos de maisons à sur la plateforme pour gagner au moins 150 000 FCFA chaque fin de mois.
                    (Voir conditions
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        ICI
                    </button> pour devenir démarcheur Tela).
                    <br><br>

                    Deuxièmement, le démarcheur après avoir reçu son virement mensuel peut décider d'épargner sur la plateforme tout en se conformant aux règles de transfère de photos et autres conditions qui seront précisées pour voir son épargne majorée d'un bonus périodique.
                    <br><br>
                    Troisièmement l'application comporte une web TV dénommée TELA TV, “La meilleure” , qui est une vitrine pour les petites et moyennes entreprises, les petits et moyens commerces mais aussi et surtout pour la jeunesse du pays tout entier. Ses émissions en Live vous permettront de vous distraire sainement et très souvent de vous faire gagner des lots et de l'argent en participant directement sur le plateau de diffusion ou en ligne. TELA TV accordera une place spéciale à la CAN 2023 qui se déroulera dans notre pays à travers des reportages sportifs, des émissions sportives en direct et probablement la diffusion en Live ou en différé de certains matchs. Nous irons à cet effet dans les coulisses des stades pour prendre la températures avec les fans ivoiriens et étrangers.
                    </font>
                </p>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Condition pour devenir démarcheur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{asset('assets/img/condition.JPG')}}" alt="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la fenetre</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection
