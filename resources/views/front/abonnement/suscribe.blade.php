@extends('layouts.front_app')
<script type="text/javascript">
    var transaction_number

    fetch("http://localhost/tela/public/api/transactions/Abonnement/getnumber").then((response) => response.json())
        .then((json) => {transaction_number = json["transaction_number"],
            console.log(transaction_number)
        });

    function payer(abonnement){

        //console.log(transaction_number)

        CinetPay.setConfig({
            apikey: '412126359654bb6ed651509.14435556',
            site_id: 5865665,
            mode: 'PRODUCTION',
            //notify_url: 'https://www.telaci.com'
        });

        // request = {
        //     "transaction_number":transaction_number,
        //     "pass_type_id":passtype['id'],
        //     "operation_id":'r134?K',
        //     "transaction_type":'PassVisite',
        //     "transaction_way":'flooz',
        //     "amount":parseInt(passtype['price']),
        // }

        /*
                    fetch("http://localhost/tela/public/pass_visite/callback", {
                        method: "POST", // or 'PUT'
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            "transaction_number":transaction_number,
                            "pass_type_id":passtype['id'],
                            "operation_id":'r134?K',
                            "transaction_type":'PassVisite',
                            "transaction_way":'flooz',
                            "amount":parseInt(passtype['price']),
                        }),
                    });
        */


        CinetPay.getCheckout({
            transaction_id: transaction_number,
            amount: parseInt(abonnement['price']),
            currency: 'XOF',
            channels: 'ALL',
            description: abonnement['title'],
            //Fournir ces variables obligatoirement pour le paiements par carte bancaire
            /*customer_name:"Visiteur",//Le nom du client
             customer_surname:"Visiteur",//Le prenom du client
             customer_email: "test@test.com",//l'email du client
             customer_phone_number: "070000000",//l'email du client
             customer_address : "BP 01",//addresse du client
             customer_city: "Abidjan",// La ville du client
             customer_country : "RCI",// le code ISO du pays
             customer_state : "RCI",// le code ISO l'état
             customer_zip_code : "001",*/ /// code postal
        });

        CinetPay.waitResponse(function(data) {
            // En cas d'échec
            if (data.status == "REFUSED") {
                if (alert("Votre paiement a échoué")) {
                    window.location.reload();
                }
            }
            // En cas de succès
            else if (data.status == "ACCEPTED") {
                if (alert("Votre paiement a été effectué avec succès")) {
                    // correct, on delivre le service
                    //window.location.reload();


                }
            }
        });
    }


</script>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="text-center">Confirmation de souscription de l'abonnement</h3>
                        <h4 class="text-danger">Souscription {{$dataAbonnement->title}}: {{$dataAbonnement->price}} F</h4> <br>
                        <h3 class="text-center text-danger">Service indisponible avant le 15 Décembre 2023</h3>


                    {{--                        <p>Veuillez patienter pendant la connexion au serveur de CINETPAY</p>--}}
                    <!--                        <button onclick="payer({{$dataAbonnement}})" class="btn btn-success">
                            PAYER {{$dataAbonnement->price}} F VIA CINETPAY
                        </button>-->
                        <img src="{{ asset('assets/img/ring.gif') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

    </div>
@endsection




