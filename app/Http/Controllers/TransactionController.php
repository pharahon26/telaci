<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //GESTION DES TRANSACTIONS
    public function getAllTransactions()
    {
        $datas = Transaction::get();
        return response()->json($datas);
    }

    public function showTransaction($id)
    {
        $data = Transaction::findOrFail($id);
        return response()->json($data);
    }

    public function getTransactionNumber(Request $request)
    {
        $type = $request->type;
        $transaction_number = 'Tela';
        $hash = Hash::make(Str::random(12));
        $transaction_number = $transaction_number.$hash.$type;
        // fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay
        $response['transaction_number'] = $transaction_number;

        return response()->json($response);

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

    public function index()
    {
        $datas = Transaction::get();
        return view('admin.transaction.index',compact('datas'));
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
