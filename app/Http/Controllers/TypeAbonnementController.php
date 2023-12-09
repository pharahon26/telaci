<?php

namespace App\Http\Controllers;

use App\TypeAbonnement;
use Illuminate\Http\Request;

class TypeAbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //GESTION DES TYPED D4ABONNEMENTS
    public function getAllTypeAbonnements()
    {
        $datas = TypeAbonnement::get();
        return response()->json($datas);
    }

    public function showTypeAbonnement($id)
    {
        $data = TypeAbonnement::findOrFail($id);
        return response()->json($data);
    }

    public function updateTypeAbonnement(Request $request, $id)
    {
        $data = TypeAbonnement::findOrFail($id);
        $data->title = $request->title;
        $data->price = $request->price;
        $data->save();
        return response()->json($data);
    }

    public function deleteTypeAbonnement(Request $request, $id)
    {
        $data = TypeAbonnement::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    public function index()
    {
        $datas = TypeAbonnement::get();
        return view('admin.typeabonnement.index',compact('datas'));
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
