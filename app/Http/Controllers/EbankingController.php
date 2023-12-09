<?php

namespace App\Http\Controllers;

use App\EbankProfil;
use App\InformationIdenty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = EbankProfil::create(
            [
                'balance'=>$request->balance,
                'created_at'=>now(),
                'information_identity_id'=>$request->information_identity_id,
            ]
        );

        return response()->json($data);
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
}
