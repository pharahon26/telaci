<?php

namespace App\Http\Controllers;

use App\CategorieProgrammeTv;
use App\ProgrammeTv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgrammeTvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //GESTION DES PROGRAMME TV
    public function getAllProgrammeTvs()
    {
        $datas = ProgrammeTv::get();
        return response()->json($datas);
    }

    public function addProgrammeTv(Request $request)
    {
        $data = ProgrammeTv::create(
            [
                'nom'=>$request->nom,
                'type'=>$request->type,
                'date_tournage'=>$request->date_tournage,
                'date_diffusion'=>$request->date_diffusion,
                'link'=>$request->link,
                'description'=>$request->description,
                'created_at'=>now(),
            ]
        );

        return response()->json($data);
    }

    public function showProgrammeTv($id)
    {
        $data = ProgrammeTv::findOrFail($id);
        return response()->json($data);
    }

    public function updateProgrammeTv(Request $request, $id)
    {
        $data = ProgrammeTv::findOrFail($id);
        $data->nom = $request->nom;
        $data->type = $request->type;
        $data->date_tournage = $request->date_tournage;
        $data->date_diffusion = $request->date_diffusion;
        $data->link = $request->link;
        $data->description = $request->description;
        $data->updated_at = now();
        $data->save();
        return response()->json($data);
    }

    public function deleteProgrammeTv(Request $request, $id)
    {
        $data = ProgrammeTv::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    public function list()
    {
        $datas = ProgrammeTv::get();
        //dd($datas);
        return view('admin.programme_tv.index',compact('datas'));
    }

    public function lienPub()
    {
        $date = '2023-12-08';
        $datas =  ProgrammeTv::where('categorie_programme_tv_id',1)
            ->where('date_diffusion','>=',$date)->first();
        //dd($datas);
        return response()->json($datas);

    }

    public function index()
    {
        $datas = CategorieProgrammeTv::get();
        return view('front.tv.index',compact('datas'));
    }

    public function listProgramme($id)
    {
        $datas = ProgrammeTv::where('categorie_programme_tv_id',$id)->get();
        return view('front.tv.list_by_category',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $categories = CategorieProgrammeTv::get();
        return view('admin.programme_tv.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'link'=>'file|mimetypes:video/mp4'
            ]);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->with('error','Veuillez choisir une video au format mp4');
        }
        else
        {
            //dd($request->categorie_programme_tv_id);
            $video = $request->file('link');
            $videoName= $video->getClientOriginalName();
            $video->move('assets/videos', $videoName);
            ProgrammeTv::create(
                [
                    'nom'=>$request->nom,
                    'categorie_programme_tv_id'=>$request->categorie_programme_tv_id,
                    'link'=>$videoName,
                    'date_tournage'=>$request->date_tournage,
                    'date_diffusion'=>$request->date_diffusion,
                    'description'=>$request->description,
                ]
            );

            return redirect()->back()->with('success','Emission enregistrée avec succès');

        }
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
