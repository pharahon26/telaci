<?php

namespace App\Http\Controllers;

use App\Models\SouscriptionPublicite;
use Illuminate\Http\Request;

class SouscriptionPackPublicitaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAllSouscriptionPackPublicitaires()
    {
        $datas = SouscriptionPublicite::get();
        return response()->json($datas);
    }

    public function createSouscriptionPackPublicitaires(Request $request)
    {
        $souscription = SouscriptionPublicite::create(
            [
                'nom'=>$request->nom,
                'entreprise'=>$request->entreprise,
                'commerciale'=>$request->commerciale,
                'pack_publicite_id'=>$request->pack_publicite_id,
            ]
        );
        if($souscription)
        {
            return response('souscription effectuée avec succès');
        }
        else
        {
            return response('Une erreur est survenue lors de la souscription');
        }
    }

    public function showSouscriptionPackPublicitaire($id)
    {
        $datas = SouscriptionPublicite::findOrFail($id);
        return response()->json($datas);
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
