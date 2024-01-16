@extends('layouts.front_app')

@section('content')
    <div class="about-container">
        <p class="about-text">
            Dans le souci de participer activement au développement de notre pays et surtout faciliter la vie aux
            populations, nous n'avons de cesse de réfléchir et apporter notre contribution pour impacter positivement la vie
            de chaque citoyen vivant sur le sol d'Eburnie.
            C'est dans cette optique que nous vous proposons la plateforme TELA. TELA est une application tout en un qui a
            été mise en place dans le but de faciliter la vie aux populations vivant en Côte d'Ivoire.
            Premièrement, avec Tela, désormais c'est facile de trouver rapidement un logement à son goût. Pour y arriver, il
            suffit de cliquer dans la rubrique “Maison à louer” pour trouver le logement de son choix.
            De plus, c'est une application qui va générer à terme plus de 30 000 emplois sur toute l'étendue du territoire
            ivoirien.
            A ce niveau il s'agit pour le citoyen lambda de transférer des photos de maisons à sur la plateforme pour gagner
            au moins 150 000 FCFA chaque fin de mois.
            (Voir conditions
            <button type="button" class="about-button" id="modalButton">
                ICI
            </button> pour devenir démarcheur Tela).

            Deuxièmement, le démarcheur après avoir reçu son virement mensuel peut décider d'épargner sur la plateforme tout
            en se conformant aux règles de transfert de photos et autres conditions qui seront précisées pour voir son
            épargne majorée d'un bonus périodique.
            Troisièmement, l'application comporte une web TV dénommée TELA TV, “La meilleure”, qui est une vitrine pour les
            petites et moyennes entreprises, les petits et moyens commerces mais aussi et surtout pour la jeunesse du pays
            tout entier. Ses émissions en Live vous permettront de vous distraire sainement et très souvent de vous faire
            gagner des lots et de l'argent en participant directement sur le plateau de diffusion ou en ligne. TELA TV
            accordera une place spéciale à la CAN 2023 qui se déroulera dans notre pays à travers des reportages sportifs,
            des émissions sportives en direct et probablement la diffusion en Live ou en différé de certains matchs. Nous
            irons à cet effet dans les coulisses des stades pour prendre la température avec les fans ivoiriens et
            étrangers.
        </p>

        <!-- Boîte modale -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">
                    <img src="{{ asset('assets/img/fermer.png') }}" class="fermer icone">
                    <p>Fermer</p>
                </span>
                <img src="{{ asset('assets/img/condition.JPG') }}" class="modal-image">
            </div>
        </div>

    </div>

    <script>
        // Obtenez la référence du bouton et de la boîte modale
        var modalButton = document.getElementById("modalButton");
        var modal = document.getElementById("myModal");

        // Fermez la boîte modale lorsque l'utilisateur clique sur la croix
        modal.querySelector(".close").addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Affichez la boîte modale lorsque l'utilisateur clique sur le bouton
        modalButton.addEventListener("click", function() {
            modal.style.display = "flex";
        });
    </script>
    <style>
        /* Style de la boîte modale */
        .modal {
            display: none;
            position: fixed;
            align-items: center;
            justify-content: center;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            width: 50vw;
            padding: 10px;
            border: 1px solid #888;
            width: max-content;
        }

        .modal-image {
            height: 90%;
            width: 100%;
        }
        .about-button {
            background-color: transparent;
            border: none;
            border-bottom: 3px solid black;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
        }
        .close {
            display: flex;
            justify-content: center;
            align-items: center;
            height: max-content;
            width: max-content;
            color: black;
            float: right;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .close p {
            margin-left: 5px;
        }
    </style>
@endsection