<?php

use CinetPay\CinetPay;
use App\TypeAbonnement;
use App\PassType;

function buy($type_abonnement_id){
/*
* CINET PAY
*/

$apiKey = "412126359654bb6ed651509.14435556"; //Veuillez entrer votre apiKey
$site_id = "5865665"; // Remplacez ce champs par votre SiteID
$const_url = 'http://localhost/telatv/public/';
// get
$type_abonnement = TypeAbonnement::find($type_abonnement_id);

$id_transaction = CinetPay::generateTransId(); // Identifiant du Paiement
$description_du_paiement = sprintf('Abonnement Demarcheur TELA %s', $id_transaction); // Description du Payment
$date_transaction = date("Y-m-d H:i:s"); // Date Paiement dans votre système
$montant_a_payer =$type_abonnement->price; //$amount; //Montant à Payer : minimun est de 100 francs sur CinetPay
$identifiant_du_payeur = 'Demarcheur-'.$id_transaction; // Mettez ici une information qui vous permettra d'identifier de façon unique le payeur
$formName = "goCinetPay"; // nom du formulaire CinetPay
$notify_url = ''; // Lien de notification CallBack CinetPay (IPN Link)
$return_url = $const_url.'abonnement/callback'; // Lien de retour CallBack CinetPay
$cancel_url = ''; //'http://service.openwifi.ci/pay/' . $userServer . '/cancel'; // Lien d'annulation CinetPay

// enregistrer le paiement

/*Paiement::create([
'user_id' => $donate->user_id,
'amount' => $donate->amount,
'trans_id' => $id_transaction,
'status' => 'init',
'donate_id' => $donate->id
]);*/

// Configuration du bouton
$btnType = 2;//1-5xwxxw
$btnSize = 'large'; // 'small' pour reduire la taille du bouton, 'large' pour une taille moyenne ou 'larger' pour  une taille plus grande

// Paramétrage du panier CinetPay et affichage du formulaire
$cp = new CinetPay($site_id, $apiKey);
try {
$cp->setTransId($id_transaction)
->setDesignation($description_du_paiement)
->setTransDate($date_transaction)
->setAmount($montant_a_payer)
->setDebug(false)// Valorisé à true, si vous voulez activer le mode debug sur cinetpay afin d'afficher toutes les variables envoyées chez CinetPay
->setCustom($identifiant_du_payeur)// optional
//->setPhonePrefixe($user_phoxne_prefix)
//->setCelPhoneNum($user_phone)
->setNotifyUrl($notify_url)// optional
->setReturnUrl($return_url)// optional
->setCancelUrl($cancel_url)// optional
->displayPayButton($formName, $btnType, $btnSize);
} catch (\Exception $e) {
print $e->getMessage();
}

/*
* END CINET PAY
*/
}

function buyPass($type_pass_id){
/*
* CINET PAY
*/

$apiKey = "412126359654bb6ed651509.14435556"; //Veuillez entrer votre apiKey
$site_id = "5865665"; // Remplacez ce champs par votre SiteID
$const_url = 'http://localhost/telatv/public/';
// get
$type_pass = PassType::where('is_visite',1)->find($type_pass_id);

$id_transaction = CinetPay::generateTransId(); // Identifiant du Paiement
$description_du_paiement = sprintf('Abonnement Demarcheur TELA %s', $id_transaction); // Description du Payment
$date_transaction = date("Y-m-d H:i:s"); // Date Paiement dans votre système
$montant_a_payer =$type_pass->price; //$amount; //Montant à Payer : minimun est de 100 francs sur CinetPay
$identifiant_du_payeur = 'Demarcheur-'.$id_transaction; // Mettez ici une information qui vous permettra d'identifier de façon unique le payeur
$formName = "goCinetPay"; // nom du formulaire CinetPay
$notify_url = ''; // Lien de notification CallBack CinetPay (IPN Link)
$return_url = $const_url.'abonnement/callback'; // Lien de retour CallBack CinetPay
$cancel_url = ''; //'http://service.openwifi.ci/pay/' . $userServer . '/cancel'; // Lien d'annulation CinetPay

// enregistrer le paiement

/*Paiement::create([
'user_id' => $donate->user_id,
'amount' => $donate->amount,
'trans_id' => $id_transaction,
'status' => 'init',
'donate_id' => $donate->id
]);*/

// Configuration du bouton
$btnType = 2;//1-5xwxxw
$btnSize = 'large'; // 'small' pour reduire la taille du bouton, 'large' pour une taille moyenne ou 'larger' pour  une taille plus grande

// Paramétrage du panier CinetPay et affichage du formulaire
$cp = new CinetPay($site_id, $apiKey);
try {
$cp->setTransId($id_transaction)
->setDesignation($description_du_paiement)
->setTransDate($date_transaction)
->setAmount($montant_a_payer)
->setDebug(false)// Valorisé à true, si vous voulez activer le mode debug sur cinetpay afin d'afficher toutes les variables envoyées chez CinetPay
->setCustom($identifiant_du_payeur)// optional
//->setPhonePrefixe($user_phoxne_prefix)
//->setCelPhoneNum($user_phone)
->setNotifyUrl($notify_url)// optional
->setReturnUrl($return_url)// optional
->setCancelUrl($cancel_url)// optional
->displayPayButton($formName, $btnType, $btnSize);
} catch (\Exception $e) {
print $e->getMessage();
}

/*
* END CINET PAY
*/
}
