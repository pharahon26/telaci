<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\EbankProfil;
use App\Models\EbankTransaction;
use App\Models\EpargneAccount;
use App\Models\EpargneTransaction;
use App\Models\InformationIdenty;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EbankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    //GESTION DES PROFIL EBANKING
    public function getAllEbankingProfils()
    {
        $datas = EbankProfil::with('informationIdentity')->get();
        return response()->json($datas);
    }

    public function addEbankingProfil(Request $request)
    {

        $checkUser = InformationIdenty::where('phone1', $request->phone)->first();
        if($checkUser){
            return response()->json('Le numero de telephone saisit existe deja', 404);
        }
        $name = $request->nom .' '.$request->prenoms;

        $photo=$request->photo;

        if($photo!=null)
        {
            $imageName=$photo;
            $photo = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }

        //on cree son profil
        $identity = InformationIdenty::create(
            [
                'name'=>$name,
                'photo'=>$photo,
                'phone1'=>$request->phone,
                'created_at'=>now(),
                'is_validated'=>0
            ]);
        // //on crée en meme temps son compte e-banking

        $profil = EbankProfil::create(
            [
                'nom'=>$request->nom,
                'prenoms'=>$request->prenoms,
                'balance'=>0,
                'photo'=>$photo,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'is_demarcheur'=>false,
                'password'=>Hash::make($request->password),
                'created_at'=>now(),
                'information_identity_id'=>$identity->id,
            ]);

        if($profil)
        {
            $data['identity'] = $identity;
            $data['profil'] = $profil;
            return response()->json($data);
        }
        else
        {
            return response()->json('Une erreur est survenue');
        }
    }


    //AUTHENTIFICATION
    public function login(Request $request){

        $checkUser = EbankProfil::where('phone', $request->phone)->first();
        if(empty($checkUser)){
            return response()->json('Le numero de telephone saisit n\'existe pas', 404);
        }
        else
        {
            if (!Hash::check($request->password, $checkUser->password))
            {
                return response()->json('Mot de passe incorrect');
            }
            else
            {
                $data['ebank_profile'] = $checkUser;
                // $data['ebank_transactions'] = $checkUser->ebankTransactions();
                // $data['transactions'] = $checkUser->transactions()->get();
                if($checkUser->has_epargne)
                {
                    /// return epargne prifile
                    $epargne = $checkUser->epargne()->get();
                    $data['epargne'] = $epargne;
                    // $data['epargne_transactions'] = $epargne->epargneTransactions();

                    // $data['transactions_ep'] = $epargne->transactions()->get();
                    return response()->json($data, 200);
                }
                else
                {
                    return response()->json($data, 200);
                }

            }
        }

        /*if(empty($user)){
            return response()->json(false, 422);
        }else{

            return response()->json($user, 200);
        }*/

    }


    public function createEpargneAccount(Request $request)
    {

        $profil = EbankProfil::where('phone', $request->phone)->first();


        // //on crée en meme temps son compte e-banking
        $epargne = EpargneAccount::create(
            [
                'balance'=>0,
                'created_at'=>now(),
                'ebank_profil_id'=>$profil->id,
            ]);

        if($epargne)
        {
            $profil->has_epargne = 1;
            $profil->save();
            $data['epargne'] = $epargne;
            $data['profil'] = $profil;
            return response()->json($data);
        }
        else
        {
            return response()->json('Une erreur est survenue', 404);
        }
    }


    public function getAllEbankTransactions(Request $request)
    {
        $phone = $request->phone;
        $ebankProfile = EbankProfil::where('phone',$phone)->first();
            $transactions = $ebankProfile->transactions()->get();
            return response()->json($transactions);


        // if ($ebankProfile) {
        //     $transactions = $ebankProfile->transactions()->get();
        //     return response()->json($transactions);
        // }else {

        //     return response()->json('Erreur innatendue');
        // }
    }



    public function getAllEpargneTransactions(Request $request)
    {
        $phone = $request->phone;
        $ebankProfile = EbankProfil::where('phone',$phone)->first();
        $ebankEpargne = EpargneAccount::where('ebank_profil_id',$ebankProfile->id)->first();
        //$data = VisiteEffectue::where('pass_visite_id',$pass->id)->get();
            $transactions = $ebankEpargne->transactions()->get();
            return response()->json($transactions);


        // if ($ebankEpargne) {
        //     //$visiteEffectue = $pass->visiteEffectue()->with('places')->get();
        //     $transactions = $ebankEpargne->transactions()->get();
        //     return response()->json($transactions);
        // }else {

        //     return response()->json('Erreur innatendue');
        // }
    }


    public function depot(Request $request)
    {

        // vérification au près de cinetpay de la transaction
        $isPayed = true;
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

        $profil = EbankProfil::where('phone', $request->phone)->first();
        // si la transaction est validé, créer la transaction et le pass
        if($isPayed){
            //succes
            //on enregistre la transaction
            $transaction = Transaction::create(
                [
                    'transaction_number'=>$request->transaction_number,
                    'date_transaction'=>now(),
                    'amount'=>$request->amount,
                    'transaction_way'=>$request->transaction_way,
                    'transaction_type'=>$request->transaction_type,
                    'operation_id'=>$request->operation_id,
                    'created_at'=>now(),
                ]
            );
            //on enregistre la transaction et on met a jour le profile
            $link = EbankTransaction::create(
                [
                    'ebank_profil_id'=>$profil->id,
                    'transaction_id'=>$transaction->id,
                    'created_at'=>now(),
                ]
                );
            $profil->balance = $profil->balance + $request->amount;
            $profil->save();


            $data['transaction'] = $transaction;
            $data['profil'] = $profil;
            $data['ebank_transaction'] = $link;

            return response()->json($data);

        }
        else
        {
            return 'Ce payement n\'a pas été reconnu';
        }

        //return response()->json($isPayed);

    }

    public function retrait(Request $request)
    {
        $amount = $request->amount;
        $fromEparge = $request->from_epargne;
        // check if balance suffisant in profile
        $profil = EbankProfil::where('phone', $request->phone)->first();
        $epargne = $profil->epagne;
        if($fromEparge){
            if ($epargne->balance < $amount) {
                return response()->json('Fond insufisant', 404);
            }
        }else{
            if ($profil->balance < ($amount + 5000)) {
                return response()->json('Fond insufisant', 404);
            }
        }

        // get token
        $token = $this->getLoginToken();
        if ($token != '') {

            // check balalnce
            $balance = $this->getLoginToken();

            // get transaction number
            $transaction_number = $this->getTransactionNumber('retrait');
            // process retrait

            if ($balance>0) {
                $r = $this->processRetrait($request->phone, '225', $token, '', $amount, $transaction_number);

                // save transaction
                $transaction = Transaction::create(
                    [
                        'transaction_number'=>$transaction_number,
                        'date_transaction'=>now(),
                        'amount'=>$amount,
                        'transaction_way'=>'mobile',
                        'transaction_type'=>"retrait",
                        'operation_id'=>$r,
                        'created_at'=>now(),
                    ]
                );

                $data['transaction'] = $transaction;

                // update account
                if ($fromEparge) {
                    $link = EpargneTransaction::create(
                        [
                            'epargne_account_id'=>$epargne->id,
                            'transaction_id'=>$transaction->id,
                            'is_retrait'=>true,
                            'created_at'=>now(),
                        ]
                        );
                    $epargne->balance = $epargne->balance - $amount;
                    $epargne->amount_freeze = $epargne->amount_freeze - $amount;
                    $epargne->debut_epargne = now();
                    $epargne->fin_epargne = now();
                    $epargne->save();
                    $data['profil'] = $epargne;
                    $data['ebank_transaction'] = $link;
                } else {

                    $link = EbankTransaction::create(
                        [
                            'ebank_profil_id'=>$profil->id,
                            'transaction_id'=>$transaction->id,
                            'is_retrait'=>true,
                            'created_at'=>now(),
                        ]
                        );
                    $profil->balance = $profil->balance - $amount;
                    $profil->save();
                    $data['profil'] = $profil;
                    $data['ebank_transaction'] = $link;
                }
                return response()->json($data);

            }else{
                return response()->json('Erreur Innatendu', 404);
            }

        }else{
            return response()->json('Erreur Innatendu', 404);
        }



    }

    public function epargner(Request $request)
    {
        // recupérer le montant epargné
        $montant = $request->montant;
        // recupérer les profil et compte epargne
        $profil = EbankProfil::where('phone', $request->phone)->first();
        // vérifier que le profil a assé d'argent
        if($profil->balance <= ($montant + 5000)){
            return response()->json('Montant du solde insuffisant pour effectuer cette opération', 404);
        }
        if ($profil->has_epargne) {
            $epargne = $profil->epargne()->get();
            // if pargne balance =0 epargne->start + amount and epargne->end = now + 7 mois and epagne->freeze = amount
            if ($epargne->balance == '0') {
                $epargne->debut_epargne = now();
                $epargne->fin_epargne = date('Y-m-d', strtotime(' + 6 month'));
            }

            // profil->balance - amount
            $profil->balance = $profil->balance -$montant;
            // epargne->balance + amount
            $epargne->balance = $epargne->balance + $montant;
            $profil->save();
            $epargne->save();

            /// créer transaction pour le mouvement de fond

            $transaction_number = $this->getTransactionNumber('epargne');
            // save transaction
            $transaction = Transaction::create(
                [
                    'transaction_number'=>$transaction_number,
                    'date_transaction'=>now(),
                    'amount'=>$montant,
                    'transaction_way'=>'mobile',
                    'transaction_type'=>"versement epargne",
                    'operation_id'=>uniqid(null,true),
                    'created_at'=>now(),
                ]
            );
            /// créer Bank Profile transaction
            $link = EbankTransaction::create(
                [
                    'ebank_profil_id'=>$profil->id,
                    'transaction_id'=>$transaction->id,
                    'is_retrait'=>true,
                    'created_at'=>now(),
                ]
                );
            /// créer epargne Profile transaction
            $link2 = EpargneTransaction::create(
                [
                    'ebank_profil_id'=>$profil->id,
                    'transaction_id'=>$transaction->id,
                    'is_retrait'=>false,
                    'created_at'=>now(),
                ]
                );

            $data['transaction'] = $transaction;
            $data['ebank_transaction'] = $link;
            $data['epargne_transaction'] = $link2;

            $data['profil'] = $profil;
            $data['epargne'] = $epargne;
            return response()->json($data);


        }else{
            return response()->json('Une erreur est survenue', 404);
        }



    }
    public function epargneInverse(Request $request)
    {
        // recupérer le montant epargné
        $montant = $request->montant;
        // recupérer les profil et compte epargne
        $profil = EbankProfil::where('phone', $request->phone)->first();
        if ($profil->has_epargne) {
            $epargne = $profil->epargne();
            // vérifier que le profil a assé d'argent
            if($epargne->balance < $montant ){
                return response()->json('Montant du solde insuffisant pour effectuer cette opération', 404);
            }
            // if pargne balance =0 epargne->start + amount and epargne->end = now + 7 mois and epagne->freeze = amount

            // profil->balance - amount
            $profil->balance = $profil->balance + $montant;
            // epargne->balance + amount
            $epargne->balance = $epargne->balance - $montant;
            $epargne->fin_epargne = date('Y-m-d', strtotime(' + 7 month'));
            $epargne->debut_epargne = now();
            $epargne->amount_freeze = $epargne->balance;
            $profil->save();
            $epargne->save();


            /// créer transaction pour le mouvement de fond

            $transaction_number = $this->getTransactionNumber('epargne');
            // save transaction
            $transaction = Transaction::create(
                [
                    'transaction_number'=>$transaction_number,
                    'date_transaction'=>now(),
                    'amount'=>$montant,
                    'transaction_way'=>'mobile',
                    'transaction_type'=>"versement de epargne",
                    'operation_id'=>uniqid(null,true),
                    'created_at'=>now(),
                ]
            );
            /// créer Bank Profile transaction
            $link = EbankTransaction::create(
                [
                    'ebank_profil_id'=>$profil->id,
                    'transaction_id'=>$transaction->id,
                    'is_retrait'=>false,
                    'created_at'=>now(),
                ]
                );
            /// créer epargne Profile transaction
            $link2 = EpargneTransaction::create(
                [
                    'ebank_profil_id'=>$profil->id,
                    'transaction_id'=>$transaction->id,
                    'is_retrait'=>true,
                    'created_at'=>now(),
                ]
                );

            $data['transaction'] = $transaction;
            $data['ebank_transaction'] = $link;
            $data['epargne_transaction'] = $link2;


            $data['profil'] = $profil;
            $data['epargne'] = $epargne;
            return response()->json($data);


        }else{
            return response()->json('Une erreur est survenue', 404);
        }



    }


    public function buyAbonementFromEbank(Request $request)
    {
        // recupère les données pour la transaction (transaction_number, amount, transaction_way, transaction_type, operation_id ) et le type de pass depuis l'utilisateur

        // vérification au près de cinetpay de la transaction
        $canPay = true;
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

        // si la transaction est validé, créer la transaction et l'abonnement

        $profil = EbankProfil::where('phone', $request->phone)->first();
        $canPay = $profil->balance >= ($request->amount + 5000);
        if($canPay){
            //succes
            //on save la transaction
            $transaction = Transaction::create(
                [
                    'transaction_number'=>$request->transaction_number,
                    'date_transaction'=>now(),
                    'amount'=>$request->amount,
                    'transaction_way'=>$request->transaction_way,
                    'transaction_type'=>$request->transaction_type,
                    'operation_id'=>$request->operation_id,
                    'created_at'=>now(),
                ]
            );
            //on enregistre l'abonnement
            $uniqid = uniqid();
            //on save l'abonnement

            $dayAfter = (now())->format('Y-m-d');
            $oldAbonnement = Abonnement::where('user_id', '=',$request->user_id)->where('end_date', '>', $dayAfter)->sortByDate('end_date')->first();
            $sd = now();
            if ($oldAbonnement) {
                $sd = $oldAbonnement->start_date;
            }
            $abonnement = Abonnement::create(
                [
                    'type'=>$request->type,
                    'type_abonnement_id'=>$request->type_abonnement_id,
                    'start_date'=>$sd,
                    'end_date'=>date('Y-m-d', strtotime(' + 1 month')),
                    'transaction_id'=>$transaction->id,
                    'created_at'=>now(),
                    'user_id'=>$request->user_id,
                    'is_actif'=>1
                ]
            );
            $profil->balance = $profil->balance - $request->amount;
            $profil->save();

            $data['transaction'] = $transaction;
            $data['abonnement'] = $abonnement;

            return response()->json($data);

        }
        else
        {
            return 'Solde insuffisant';
        }

    }


    public function showEbankingProfil($id)
    {
        $data = EbankProfil::findOrFail($id);
        return response()->json($data);
    }

    public function updateEbankingProfil(Request $request, $id)
    {
        $data = EbankProfil::findOrFail($id);
        $data->balance = $request->balance;
        $data->information_identity_id = $request->information_identity_id;
        $data->updated_at = now();
        $data->save();
        return response()->json($data);
    }



    public function index()
    {
        if(Auth::check())
        {
            $auth = Auth::user()->id;
            $information = InformationIdenty::where('user_id',$auth)->first();
            $datas = EbankProfil::where('information_identity_id',$information->id)->first();
            return view('front.finance.index',compact('datas'));
        }
        else
        {
            return view('front.finance.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function checkStatutTransactions($cpm_trans_id, $amount)
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::post('https://api-checkout.cinetpay.com/v2/payment/check',[
            'apikey ' => '412126359654bb6ed651509.14435556',
            'site_id ' => '5865665',
            'transaction_id  ' => $cpm_trans_id,
        ]);

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '00' && $jsonData->data->amount == $amount) {
            return true;
        } else {
            return false;
        }

    }


    public function getLoginToken()
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::asForm()->post('https://client.cinetpay.com/v1/auth/login',[
            'apikey ' => '412126359654bb6ed651509.14435556',
            'password ' => '5865665',
        ]);

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '0') {
            return $jsonData->data->token;
        } else {
            return '';
        }

    }


    public function checkBalance($amount, $token)
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::asForm()->withToken($token)->get('https://client.cinetpay.com/v1/transfer/check/balance');

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '0' && $jsonData->available > $amount) {
            return $jsonData->available;
        } else {
            return 0;
        }

    }


    // ajouter numero 0 la liste de contacts CINET_PAY
    public function addNumber($phone, $prefix='225', $token, $mail='', $name)
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::withToken($token)->post('https://client.cinetpay.com/v1/transfer/contact',[
            "prefix"=> $prefix,
            "phone" => $phone,
            "name" => $name,
            "surname" => $name,
            "email" => $mail
        ] );

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '0') {
            return true;
        } else {
            return false;
        }

    }


    public function processRetrait($phone, $prefix='225', $token, $mail='', $amount, $transaction_number)
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::asForm()->withToken($token)->post('https://client.cinetpay.com/v1/transfer/money/send/contact', [
                    "prefix" => $prefix,
                    "phone" => $phone,
                    "amount" => $amount,
                    "client_transaction_id" => $transaction_number,
                    "notify_url" => "http://yourdomain.com/transfer/notify",
                    // "payment_method" => "WAVECI"
                ]);

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '0' ) {
            return $jsonData->data->transaction_id;
        } else {
            return "";
        }

    }

    public function getTransactionNumber($type)
    {
        $transaction_number = 'Tela';
        $hash = Hash::make(Str::random(12));
        $transaction_number = $transaction_number.$hash.$type;

        return $transaction_number;

    }

    private function savePicture($base64_string, $output_file) {
        $dirPlace = 'assets/img/places/';
        $dirPhoto = 'assets/img/users/photo/';
        $dirPieces = 'assets/img/users/pieces/';
        if(!is_dir($dirPlace)){
            mkdir( $dirPlace , 0755, true);
        }
        if(!is_dir($dirPhoto)){
            mkdir( $dirPhoto , 0755, true);
        }
        if(!is_dir($dirPieces)){
            mkdir( $dirPieces , 0755, true);
        }
        // chdir($old.$path_to_file);
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        // $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $base64_string ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }



}
