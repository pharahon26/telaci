<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>
    <style>
        .sdk {
            display: block;
            position: absolute;
            background-position: center;
            text-align: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <script type="text/javascript">
        var transaction_number

        fetch("http://localhost/tela/public/api/transactions/Visite/getnumber").then((response) => response.json())
            .then((json) => {transaction_number = json["transaction_number"],
                console.log(transaction_number)
            });

        function payer(passtype){

            //console.log(transaction_number)

            CinetPay.setConfig({
                apikey: '412126359654bb6ed651509.14435556',
                site_id: 5865665,
                mode: 'PRODUCTION',
                //notify_url: 'https://www.telaci.com'
            });

            console.log(parseInt(passtype['price']));

            CinetPay.getCheckout({
                transaction_id: transaction_number,
                amount: parseInt(passtype['price']),
                currency: 'XOF',
                channels: 'ALL',
                description: passtype['name'],
                //Fournir ces variables obligatoirement pour le paiements par carte bancaire
                /* customer_name:"Visiteur",//Le nom du client
                 customer_surname:"Visiteur",//Le prenom du client
                 customer_email: "test@test.com",//l'email du client
                 customer_phone_number: "070000000",//l'email du client
                 customer_address : "BP 01",//addresse du client
                 customer_city: "Abidjan",// La ville du client
                 customer_country : "RCI",// le code ISO du pays
                 customer_state : "RCI",// le code ISO l'état
                 customer_zip_code : "001", */// code postal
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
                        window.location.reload();
                    }
                }
            });
        }


    </script>
    <title>Preparation du paiement</title>
</head>

<body>
<div class="sdk">
    <h1>Paiement du pass visite</h1>
    {{$dataPassVisite->name}}: {{$dataPassVisite->price}} F
    <button onclick="payer({{$dataPassVisite}})">Payer</button>

</div>
</body>
</html>
