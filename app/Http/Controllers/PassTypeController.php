<?php

namespace App\Http\Controllers;

use App\PassType;
use Illuminate\Http\Request;

class PassTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //GESTION DES TYPE DE PASS
    public function getAllPassTypes()
    {
        $datas = PassType::get();
        return response()->json($datas);
    }

    public function addPassType(Request $request)
    {
        $data = PassType::create(
            [
                'name'=>$request->name,
                'price'=>$request->price,
                'is_visite'=>$request->is_visite,
                'nb_visite'=>$request->nb_visite,
                'created_at'=>now(),

            ]
        );

        return response()->json($data);
    }

    public function showPassType($id)
    {
        $data = PassType::findOrFail($id);
        return response()->json($data);
    }

    public function index()
    {
        $datas = PassType::get();
        return view('admin.typepass.index',compact('datas'));

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
