<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\Place;
use App\Transaction;
use App\TypeAbonnement;
use CinetPay\CinetPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //GESTION DES ABONNEMENTS
    public function getAllAbonnements()
    {
        $datas = Abonnement::get();
        return response()->json($datas);
    }

    public function buyAbonement(Request $request)
    {
        // recupère les données pour la transaction (transaction_number, amount, transaction_way, transaction_type, operation_id ) et le type de pass depuis l'utilisateur

        // vérification au près de cinetpay de la transaction
        $isPayed = true;
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

        // si la transaction est validé, créer la transaction et l'abonnement
        if($isPayed){
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
            //on enregistre le pass_visite
            $uniqid = uniqid();
            //on save l'abonnement
            $abonnement = Abonnement::create(
                [
                    'type'=>$request->type,
                    'type_abonnement_id'=>$request->type_abonnement_id,
                    'start_date'=>now(),
                    'end_date'=>date('Y-m-d', strtotime(' + 1 month')),
                    'transaction_id'=>$transaction->id,
                    'created_at'=>now(),
                    'user_id'=>$request->user_id,
                    'is_actif'=>1
                ]
            );

            $user_places = Place::where('user_id',$request->user_id)->get();
            foreach ($user_places as $item)
            {
                if($item->is_validated==false)
                {
                    $item->is_validated =true;
                    $item->save();
                }
            }

            $data['transaction'] = $transaction;
            $data['abonnement'] = $abonnement;

            return response()->json($data);

        }
        else
        {
            return 'Ce payement n\'a pas été reconnu';
        }

    }

    public function freeAbonement(Request $request)
    {

        //on save l'abonnement
        $abonnement = Abonnement::create(
            [
                'type'=>$request->type,
                'type_abonnement_id'=>$request->type_abonnement_id,
                'start_date'=>now(),
                'end_date'=>date('Y-m-d', strtotime(' + 1 month')),
                'transaction_id'=>1,
                'created_at'=>now(),
                'user_id'=>$request->user_id,
                'is_actif'=>1
            ]
        );

        $data['abonnement'] = $abonnement;

        return response()->json($data);
    }

    public function showAbonnement($id)
    {
        $data = Abonnement::findOrFail($id);
        return response()->json($data);
    }

    public function index()
    {
        $datas = Abonnement::with('transaction')->get();
        //dd($datas);
        return view('admin.abonnement.index', compact('datas'));
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

    public function showFormAbonnement()
    {
        $datasAbonnements = TypeAbonnement::get();
        return view('front.abonnement.index', compact('datasAbonnements'));
    }

    public function showSuscribeForm($id)
    {
        $dataAbonnement = TypeAbonnement::findOrFail($id);
        return view('front.abonnement.suscribe', compact('dataAbonnement'));
    }

    public function listAbonnementDemarcheur()
    {
        $auth = Auth::user()->id;
        $datas = Abonnement::where('user_id',$auth)->get();
        return view('front.abonnement.show',compact('datas'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = Abonnement::findOrFail($id);
        return view('admin.abonnement.show', compact('data'));
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
