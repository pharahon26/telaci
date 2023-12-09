<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\PassType;
use App\PassVisite;
use App\Place;
use App\Transaction;
use App\TypeAbonnement;
use App\User;
use App\VisiteEffectue;
use Illuminate\Http\Request;

class PassVisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //GESTION DES PASS DE VISITE
    public function getAllPassVisites()
    {
        $datas = PassVisite::with('user','passType','transactionData')->get();
        return response()->json($datas);
    }

    public function buyPassVisite(Request $request)
    {
        // recupère les données pour la transaction (transaction_number, amount, transaction_way, transaction_type, operation_id ) et le type de pass depuis l'utilisateur

        // vérification au près de cinetpay de la transaction
        $isPayed = true;
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

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
            //on enregistre le pass_visite
            $uniqid = uniqid(null,true);

            //on recupere le type de passe
            $data_type_pass = PassType::findOrFail($request->pass_type_id);
            $passvisite = PassVisite::create(
                [
                    'transaction_number'=>$request->transaction_number,
                    'code'=>substr($uniqid, 0, 8),
                    'end_date'=>date('Y-m-d', strtotime(' + 7 days')),
                    'nb_visite'=>$data_type_pass->nb_visite,
                    'is_expired'=>false,
                    'is_confirmed'=>1,
                    'pass_type_id'=>$data_type_pass->id,
                    'transaction_id'=>$transaction->id,
                    'created_at'=>now(),

                ]
            );

            //on enregistre dans les cookies
            $cookiePassVisite = cookie('code_passvisite', $passvisite->code, 10080);

            $data['transaction'] = $transaction;
            $data['passvisite'] = $passvisite;
            $data['cookie'] = $cookiePassVisite;

            return response()->json($data)->cookie($cookiePassVisite);

        }
        else
        {
            return 'Ce payement n\'a pas été reconnu';
        }

        //return response()->json($isPayed);

    }

    public function prolongePassVisite(Request $request)
    {
        // recupère les données pour la transaction (transaction_number, amount, transaction_way, transaction_type, operation_id ) et le type de pass depuis l'utilisateur

        // vérification au près de cinetpay de la transaction
        $isPayed = true;
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

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
            // on récupère le code
            $code = $request->code;
            //on recupere le type de passe
            $data_type_pass = PassType::findOrFail($request->pass_type_id);

            $passvisite = PassVisite::with('passType','transactionData')
                ->where('code',$code)->first();
            /*$passvisite->nb_visite = $data_type_pass->nb_visite;
            $passvisite->transaction_number = $request->transaction_number;
            $passvisite->pass_type_id = $data_type_pass->id;
            $passvisite->end_date = date_add($passvisite->end_date, date_interval_create_from_date_string('+ 7 days'));
            $passvisite->save();*/

            $passvisite->update([
                'nb_visite'=>$passvisite->nb_visite + $data_type_pass->nb_visite,
                'transaction_number' => $request->transaction_number,
                'pass_type_id' => $data_type_pass->id,
                'end_date' => date_add(date_create($passvisite->end_date), date_interval_create_from_date_string('+ 7 days'))->format('Y-m-d H:i:s'),
            ]);

            $data['transaction'] = $transaction;
            $data['passvisite'] = $passvisite;

            return response()->json($data);

        }
        else
        {
            return 'Ce payement n\'a pas été reconnu';
        }

    }

    // one visite faite on décrémente de 1 le nombre de visites du pass
    public function passM(Request $request)
    {
        // l'utilisatuer quand il visite  une maison nous envoie le code du pass utilisé avec l'id de la maison visité
        $code = $request->code;
        $placeId = $request->place_id;

        // récupère le pass visite avec les maisons visité aux quelles il est lié dans la table "visites effectué"
        $data = PassVisite::where('code',$code)->first();

        // $checkData = VisiteEffectue::where('pass_visite_id',$data->id)
        //     ->where('place_id',$placeId)->first();

        if($data->is_expired){
            return response()->json($data);
        }
        if($data->nb_visite<=0)
        {
            $data->is_expired = 1;
            return response()->json($data);
        }

        // si l'id de la maison est dans la liste ne rien faire
        // if($checkData ==null)
        if(true)
        {
            //  décrémenter le nombre de visites du pass et lier le pass a la maison dans la table visites effectué
            $data->nb_visite = $data->nb_visite -1;
            if($data->nb_visite==0)
            {
                $data->is_expired = True;
            }
            else
            {
                $data->is_expired = False;
            }
            $data->save();
            //on enregistre les datas dans la table VisiteEffectue
            // VisiteEffectue::create(
            //     [
            //         'pass_visite_id'=>$data->id,
            //         'place_id'=>$placeId,
            //     ]
            // );
        }

        return response()->json($data);

    }

    public function verifPassVisite(Request $request)
    {
        $code = $request->code;
        $data = PassVisite::with('passType','transactionData')
            ->where('code',$code)->first();
        return response()->json($data);
    }

/*    public function checkOnePassVisite(Request $request, $code)
    {
        $code = $request->code;
        $data = PassVisite::with('user','passType')
            ->where('code',$code)->first();

        $data = PassVisite::findOrFail($data->id);
        $data->nb_visite = $data->nb_visite - 1;
        if($data->nb_visite==0)
        {
            $data->is_expired = 1;
        }
        else
        {
            $data->is_expired = 0;
        }
        $data->save();
        return response()->json($data);
    }*/

    public function getPassVisitePlaces(Request $request)
    {
        $code = $request->code;
        $pass = PassVisite::where('code',$code)->first();
        //$data = VisiteEffectue::where('pass_visite_id',$pass->id)->get();

        if ($pass) {
            //$visiteEffectue = $pass->visiteEffectue()->with('places')->get();
            $visiteEffectue = $pass->places()->get();
            return response()->json($visiteEffectue);
        }else {

            return response()->json('Erreur innatendue');
        }


    }

    public function showPassVisite($id)
    {
        $data = PassVisite::with('passType','transactionData')->findOrFail($id);
        return response()->json($data);
    }

    public function indexPass()
    {
        $datas = PassType::where('is_visite',1)->get();
        return view('front.passvisite.index',compact('datas'));
    }

    public function checkPassVisite(Request $request)
    {
        $datas = PassType::where('is_visite',1)->get();
        $check = PassVisite::where('code',$request->code)->first();
        //dd($check);
        return view('front.passvisite.resultat',compact('check','datas'));
    }

    public function showBuyForm(Request $request,$id)
    {
        //on recupere les data du pass visite concerné
        $dataPassVisite = PassType::findOrFail($id);

        return view('front.passvisite.show_buy',compact('dataPassVisite'));
    }

    public function callBackPassViste(Request $request)
    {
        // vérification au près de cinetpay de la transaction
        $isPayed = true;
        //dd($request);
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

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
            //on enregistre le pass_visite
            $uniqid = uniqid(null,true);

            //on recupere le type de passe
            $data_type_pass = PassType::findOrFail($request->pass_type_id);
            $passvisite = PassVisite::create(
                [
                    'transaction_number'=>$request->transaction_number,
                    'code'=>substr($uniqid, 0, 8),
                    'end_date'=>date('Y-m-d', strtotime(' + 7 days')),
                    'nb_visite'=>$data_type_pass->nb_visite,
                    'is_expired'=>0,
                    'is_confirmed'=>1,
                    'pass_type_id'=>$data_type_pass->id,
                    'transaction_id'=>$transaction->id,
                    'created_at'=>now(),

                ]
            );

            //on enregistre dans les cookies
            $cookiePassVisite = cookie('code_passvisite', $passvisite->code, 10080);

            $data['transaction'] = $transaction;
            $data['passvisite'] = $passvisite;
            $data['cookie'] = $cookiePassVisite;

            //return response()->json($data)->cookie($cookiePassVisite);
            return redirect()->route('passvisite.notify');
                //->cookie($cookiePassVisite);
        }
        else
        {
            return redirect()->back()->with('danger','Ce payement n\'a pas été reconnu');
        }

        //return view('front.passvisite.buy',compact('dataPassVisite','response'));
    }

    public function index()
    {
        $datas = PassVisite::get();
        return view('admin.passvisite.index',compact('datas'));
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
}
