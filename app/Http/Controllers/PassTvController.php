<?php

namespace App\Http\Controllers;

use App\Models\PassTv;
use App\Models\PassType;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PassTvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //GESTION DES PASS TV
    public function getAllPassTvs()
    {
        $datas = PassTv::with('user','passType','transactionData','programmeTv')->get();
        return response()->json($datas);
    }

    public function buyPassTv(Request $request)
    {

        if($request->cpm_result == '00'){
            //succes
            //on enregistre la transaction
            $transaction = Transaction::create(
                [
                    'transaction_number'=>$request->cpm_trans_id,
                    'date_transaction'=>now(),
                    'amount'=>$request->amount,
                    'transaction_way'=>$request->transaction_way,
                    'transaction_type'=>$request->transaction_type,
                    'operation_id'=>$request->operation_id,
                    'created_at'=>now(),
                ]
            );

            //on enregistre le pass_ de tv
            $uniqid = uniqid();
            //on recupere le type de passe
            $data_type_pass = PassType::findOrFail($request->pass_type_id);
            $passtv = PassTv::create(
                [
                    'transaction_number'=>$request->cpm_trans_id,
                    'code'=>substr($uniqid, 0, 8),
                    'end_date'=>date('Y-m-d', strtotime(' + 1 days')),
                    'is_actif'=>1,
                    'pass_type_id'=>$data_type_pass->id,
                    'transaction_id'=>$transaction->id,
                    'programme_tv_id'=>$request->programme_tv_id,
                    'created_at'=>now(),

                ]
            );
            $data['transaction'] = $transaction;
            $data['passtv'] = $passtv;

            return response()->json($data);

        }
        else
        {
            return 'Une erreur est survenue lors du paiement';
        }

    }

    public function verifPassTv(Request $request)
    {
        $code = $request->code;
        $data = PassTv::with('user','passType','transactionData','programmeTv')
            ->where('code',$code)->get();
        return response()->json($data);
    }

    public function index()
    {
        //
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
