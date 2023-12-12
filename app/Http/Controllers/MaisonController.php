<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Image;
use App\PassVisite;
use App\Place;
use App\VisiteEffectue;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    //GESTION DES MAISONS
    public function getAllPlaces()
    {
        $datas = Place::with('image')->get();
        return response()->json($datas);
    }
    public function searchPlace(Request $request)
    {


        $datas = Place::where('commune_id',$request->commune_id)
        ->where('is_occupe',0)
            // ->where('nombre_piece',$request->nombre_piece)
            // ->where('nombre_salle_eau',$request->nombre_salle_eau)
            //->where('is_Bureau',0)
            ->where('is_validated',1)
            ->where(function ($query) use ($request) {
                $query->orWhere('is_Appartment', $request->is_Appartment)
                    ->orWhere('is_MAISON_BASSE', $request->is_MAISON_BASSE)
                    ->orWhere('is_Studio', $request->is_Studio)
                    ->orWhere('is_Chambre', $request->is_Chambre)
                    ->orWhere('is_Residence', $request->is_Residence)
                    ->orWhere('is_DUPLEX', $request->is_DUPLEX)
                    ->orWhere('is_HAUT_STANDING', $request->is_HAUT_STANDING)
                    ->orWhere('has_PISCINE', $request->has_PISCINE)
                    ->orWhere('has_GARDIEN', $request->has_GARDIEN)
                    ->orWhere('has_GARAGE', $request->has_GARAGE)
                    ->orWhere('has_COUR_AVANT',$request->has_COUR_AVANT)
                    ->orWhere('has_COUR_ARRIERE',$request->has_COUR_ARRIERE)
                    ->orWhere('has_balcon_avant', $request->has_balcon_avant)
                    ->orWhere('has_balcon_arriere', $request->has_balcon_arriere)
                    ->orWhere('has_COUR_AVANT',$request->has_COUR_AVANT)
                    ->orWhere('has_COUR_ARRIERE',$request->has_COUR_ARRIERE);
                    ;
            })
            ->paginate(50)
            ->with('image')
            ->get();
        return response()->json($datas);
    }

    public function searchBureau(Request $request)
    {
        $datas = Place::where('commune_id',$request->commune_id)
            ->where('is_validated',1)
            ->where('is_occupe',0)
            //->where('is_Bureau',1)
            //->where('is_rejected',0)
            ->orWhere(function ($query) use ($request) {
                $query->orWhere('nombre_piece','>=',$request->nombre_piece)
                    ->orWhere('nombre_salle_eau','>=',$request->nombre_salle_eau)
                    ->orWhere('is_Appartment', $request->is_Appartment)
                    ->orWhere('is_MAISON_BASSE', $request->is_MAISON_BASSE)
                    ->orWhere('is_Studio', $request->is_Studio)
                    ->orWhere('is_Chambre', $request->is_Chambre)
                    ->orWhere('is_Residence', $request->is_Residence)
                    ->orWhere('is_DUPLEX', $request->is_DUPLEX)
                    ->orWhere('is_HAUT_STANDING', $request->is_HAUT_STANDING)
                    ->orWhere('has_PISCINE', $request->has_PISCINE)
                    ->orWhere('has_GARDIEN', $request->has_GARDIEN)
                    ->orWhere('has_GARAGE', $request->has_GARAGE)
                    ->orWhere('has_balcon_avant', $request->has_balcon_avant)
                    ->orWhere('has_balcon_arriere', $request->has_balcon_arriere)
                ->orWhere('has_COUR_AVANT',$request->has_COUR_AVANT)
                    ->orWhere('has_COUR_ARRIERE',$request->has_COUR_ARRIERE);
            })
            ->paginate(50)
            ->with('image')
            ->get();
        return response()->json($datas);
    }

    public function addPlace(Request $request)
    {
        //on compte le nb d'enregistrement existant
        $count = Place::count('id');
        $data = Place::create(
            [
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'price'=>$request->price,
                'proprio_name'=>$request->proprio_name,
                'proprio_telephone'=>$request->proprio_telephone,
                'user_id'=>$request->user_id,
                'description'=>$request->description,
                'created_at'=>now(),
                'is_Studio'=>$request->is_Studio,
                'is_Chambre'=>$request->is_Chambre,
                'is_occupe'=>$request->is_occupe,
                'is_Residence'=>$request->is_Residence,
                'is_Appartment'=>$request->is_Appartment,
                'is_Bureau'=>$request->is_Bureau,
                'is_MAISON_BASSE'=>$request->is_MAISON_BASSE,
                'is_DUPLEX'=>$request->is_DUPLEX,
                'has_PISCINE'=>$request->has_PISCINE,
                'is_HAUT_STANDING'=>$request->is_HAUT_STANDING,
                'has_COUR_AVANT'=>$request->has_COUR_AVANT,
                'has_COUR_ARRIERE'=>$request->has_COUR_ARRIERE,
                'has_GARDIEN'=>$request->has_GARDIEN,
                'has_GARAGE'=>$request->has_GARAGE,
                'has_balcon_avant'=>$request->has_balcon_avant,
                'has_balcon_arriere'=>$request->has_balcon_arriere,
                'nombre_piece'=>$request->nombre_piece,
                'nombre_salle_eau'=>$request->nombre_salle_eau,
                'is_validated'=>$request->is_validated,
                'commune_id'=>$request->commune_id,
                'image_id'=>$count+1,
                'ref'=>uniqid()

            ]
        );
        //on enregistre dans la table image la photo
        //traitement image
        /*$arrImg = [];
        $array_image = [];
        for ($i=0; $i<=9; $i++)
        {
            $image=$request->picture;
            $image.$i = $request->picture.$i;
        // $arrImg = [];
        // $array_image = [];
        // for ($i=0; $i<=9; $i++)
        // {
        //     $image=$request->picture;
        //     $image.$i = $request->picture.$i;

        //     if($image.$i!=null)
        //     {
        //         $imageName=$image.$i;
        //         $image.$i = $this->savePicture($imageName, ('assets/img/places/'.rand(1,9999999999999999).'.jpg'));
        //     }
        //     else
        //     {
        //         $imageName=null;
        //         $image.$i=null;
        //     }

        //     $array_image = array_push($arrImg,$image.$i);
        // }

        Image::create(
            [
                'place_id'=>$data->image_id,
                'url'=>$array_image,
                'created_at'=>now(),
            ]
        );*/
        // Image::create(
        //     [
        //         'place_id'=>$data->image_id,
        //         'url'=>$array_image,
        //         'created_at'=>now(),
        //     ]
        // );

        return response()->json($data);
    }

    public function showPlace($id)
    {
        $data = Place::findOrFail($id);
        return response()->json($data);
    }

    public function updatePlace(Request $request, $id)
    {
        $data = Place::findOrFail($id);
        $data->latitude=$request->latitude;
        $data->longitude=$request->longitude;
        $data->price=$request->price;
        $data->proprio_name=$request->proprio_name;
        $data->proprio_telephone=$request->proprio_telephone;
        $data->demarcheur_id=$request->demarcheur_id;
        $data->description=$request->description;
        $data->is_Studio=$request->is_Studio;
        $data->is_Chambre=$request->is_Chambre;
        $data->is_Appartment=$request->is_Appartment;
        $data->is_Bureau=$request->is_Bureau;
        $data->is_MAISON_BASSE=$request->is_MAISON_BASSE;
        $data->is_DUPLEX=$request->is_DUPLEX;
        $data->has_PISCINE=$request->has_PISCINE;
        $data->is_HAUT_STANDING=$request->is_HAUT_STANDING;
        $data->has_COUR_AVANT=$request->has_COUR_AVANT;
        $data->has_COUR_ARRIERE=$request->has_COUR_ARRIERE;
        $data->has_GARDIEN=$request->has_GARDIEN;
        $data->has_GARAGE=$request->has_GARAGE;
        $data->has_balcon_avant=$request->has_balcon_avant;
        $data->has_balcon_arriere=$request->has_balcon_arriere;
        $data->nombre_piece=$request->nombre_piece;
        $data->nombre_salle_eau=$request->nombre_salle_eau;
        $data->is_validated=$request->is_validated;
        $data->is_occupe=$request->is_occupe;
        $data->commune_id=$request->commune_id;
        $data->updated_at = now();
        $data->save();
        return response()->json($data);
    }

    public function deletePlace(Request $request, $id)
    {
        $data = Place::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    public function getMyPlaces(Request $request, $id)
    {
        $a = Place::with('image')->where('user_id', '=',$id)->withCount('passvisites')->get();
        return response()->json($a);
        }

    public function index()
    {
        $datas = Place::get();
        //dd($datas);
        return view('admin.maison.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function indexCatalogue()
    {
        $auth_user_id = Auth::user()->id;
        $datas = Place::where('user_id',$auth_user_id)->OrderBy('id','DESC')->get();
        return view('front.catalogue.index',compact('datas'));
    }

    public function choix()
    {
        return view('front.maison.index');
    }

    public function showFormLogement()
    {
        $communes = Commune::get();
        return view('front.maison.show_form_logement',compact('communes'));
    }

    public function showFormBureau()
    {
        $communes = Commune::get();
        return view('front.maison.show_form_bureau',compact('communes'));
    }

    public function searchLogement(Request $request)
    {
        // Récupère la valeur du cookie
        $cookiePassVisite = $request->cookie('code_passvisite');
        $studio = $request->is_Studio;
        $chambre = $request->is_Chambre;
        $residence = $request->is_Residence;
        $appartement = $request->is_Appartment;
        $maisonbasse = $request->is_MAISON_BASSE;
        $duplexe = $request->is_DUPLEX;
        $haspiscine = $request->has_PISCINE;
        $couravant = $request->has_COUR_AVANT;
        $courarriere = $request->has_COUR_ARRIERE;
        $balconavant = $request->has_balcon_avant;
        $balconarriere = $request->has_balcon_arriere;
        $hasgardien = $request->has_GARDIEN;
        $hasgarage = $request->has_GARAGE;
        //
        if ($studio=='on')
        {
            $request->is_Studio =1;
        }else
        {
            $request->is_Studio=0;
        }
        if ($chambre=='on')
        {
            $request->is_Chambre=1;
        }else
        {
            $request->is_Chambre =0;
        }
        if ($residence=='on')
        {
            $request->is_Residence=1;
        }else
        {
            $request->is_Residence=0;
        }
        if ($appartement=='on')
        {
            $request->is_Appartment=1;
        }else
        {
            $request->is_Appartment=0;
        }
        if ($maisonbasse=='on')
        {
            $request->is_MAISON_BASSE=1;
        }else
        {
            $request->is_MAISON_BASSE=0;
        }
        if ($duplexe=='on')
        {
            $request->is_DUPLEX=1;
        }else
        {
            $request->is_DUPLEX=0;
        }
        if ($haspiscine=='1')
        {
            $valueHautStanding=1;
            $request->has_PISCINE=1;
        }else
        {
            $valueHautStanding=1;
            $request->has_PISCINE=0;
        }
        if ($couravant=='on')
        {
            $request->has_COUR_AVANT=1;
        }else
        {
            $request->has_COUR_AVANT=0;
        }
        if ($courarriere=='on')
        {
            $request->has_COUR_ARRIERE=1;
        }else
        {
            $request->has_COUR_ARRIERE=0;
        }
        if ($balconavant=='on')
        {
            $request->has_balcon_avant=1;
        }else
        {
            $request->has_balcon_avant=0;
        }
        if ($balconarriere=='on')
        {
            $request->has_balcon_arriere=1;
        }else
        {
            $request->has_balcon_arriere=0;
        }
        if ($hasgardien=='on')
        {
            $request->has_GARDIEN=1;
        }else
        {
            $request->has_GARDIEN=0;
        }
        if ($hasgarage=='on')
        {
            $request->has_GARAGE=1;
        }else
        {
            $request->has_GARAGE=0;
        }

        $data_search =  Place::where('commune_id',$request->commune_id)
            ->where('is_validated',1)
            ->where('is_occupe',0)
            //->where('is_Bureau',0)
            //->where('is_rejected',0)
            ->where(function ($query) use ($request) {
                $query->orWhere('nombre_piece','>=',$request->nombre_piece)
                    ->orWhere('nombre_salle_eau','>=',$request->nombre_salle_eau)
                    ->orWhere('is_Appartment', $request->is_Appartment)
                    ->orWhere('is_MAISON_BASSE', $request->is_MAISON_BASSE)
                    ->orWhere('is_Studio', $request->is_Studio)
                    ->orWhere('is_Chambre', $request->is_Chambre)
                    ->orWhere('is_Residence', $request->is_Residence)
                    ->orWhere('is_DUPLEX', $request->is_DUPLEX)
                    ->orWhere('is_HAUT_STANDING', 1)
                    ->orWhere('has_PISCINE', $request->has_PISCINE)
                    ->orWhere('has_GARDIEN', $request->has_GARDIEN)
                    ->orWhere('has_GARAGE', $request->has_GARAGE)
                    ->orWhere('has_balcon_avant', $request->has_balcon_avant)
                    ->orWhere('has_balcon_arriere', $request->has_balcon_arriere)
                    ->orWhere('has_COUR_AVANT',$request->has_COUR_AVANT)
                    ->orWhere('has_COUR_ARRIERE',$request->has_COUR_ARRIERE);
            })
            //->paginate('50')
            ->with('image')
            ->get();
        //dd($data_search);
        return view('front.maison.result_logement', compact('data_search','cookiePassVisite'));

    }

    public function rechercheBureau(Request $request)
    {
        // Récupère la valeur du cookie
        $cookiePassVisite = $request->cookie('code_passvisite');
        $studio = $request->is_Studio;
        $chambre = $request->is_Chambre;
        $residence = $request->is_Residence;
        $appartement = $request->is_Appartment;
        $maisonbasse = $request->is_MAISON_BASSE;
        $duplexe = $request->is_DUPLEX;
        $haspiscine = $request->has_PISCINE;
        $couravant = $request->has_COUR_AVANT;
        $courarriere = $request->has_COUR_ARRIERE;
        $balconavant = $request->has_balcon_avant;
        $balconarriere = $request->has_balcon_arriere;
        $hasgardien = $request->has_GARDIEN;
        $hasgarage = $request->has_GARAGE;
        //
        if ($studio=='on')
        {
            $request->is_Studio =1;
        }else
        {
            $request->is_Studio=0;
        }
        if ($chambre=='on')
        {
            $request->is_Chambre=1;
        }else
        {
            $request->is_Chambre =0;
        }
        if ($residence=='on')
        {
            $request->is_Residence=1;
        }else
        {
            $request->is_Residence=0;
        }
        if ($appartement=='on')
        {
            $request->is_Appartment=1;
        }else
        {
            $request->is_Appartment=0;
        }
        if ($maisonbasse=='on')
        {
            $request->is_MAISON_BASSE=1;
        }else
        {
            $request->is_MAISON_BASSE=0;
        }
        if ($duplexe=='on')
        {
            $request->is_DUPLEX=1;
        }else
        {
            $request->is_DUPLEX=0;
        }
        if ($haspiscine=='1')
        {
            $valueHautStanding=1;
            $request->has_PISCINE=1;
        }else
        {
            $valueHautStanding=1;
            $request->has_PISCINE=0;
        }
        if ($couravant=='on')
        {
            $request->has_COUR_AVANT=1;
        }else
        {
            $request->has_COUR_AVANT=0;
        }
        if ($courarriere=='on')
        {
            $request->has_COUR_ARRIERE=1;
        }else
        {
            $request->has_COUR_ARRIERE=0;
        }
        if ($balconavant=='on')
        {
            $request->has_balcon_avant=1;
        }else
        {
            $request->has_balcon_avant=0;
        }
        if ($balconarriere=='on')
        {
            $request->has_balcon_arriere=1;
        }else
        {
            $request->has_balcon_arriere=0;
        }
        if ($hasgardien=='on')
        {
            $request->has_GARDIEN=1;
        }else
        {
            $request->has_GARDIEN=0;
        }
        if ($hasgarage=='on')
        {
            $request->has_GARAGE=1;
        }else
        {
            $request->has_GARAGE=0;
        }

        $data_search =  Place::where('commune_id',$request->commune_id)
            ->where('is_validated',1)
            ->where('is_occupe',0)
            //->where('is_Bureau',1)
            //->where('is_rejected',0)
            ->where(function ($query) use ($request) {
                $query->orWhere('nombre_piece','>=',$request->nombre_piece)
                    ->orWhere('nombre_salle_eau','>=',$request->nombre_salle_eau)
                    ->orWhere('is_Appartment', $request->is_Appartment)
                    ->orWhere('is_MAISON_BASSE', $request->is_MAISON_BASSE)
                    ->orWhere('is_Studio', $request->is_Studio)
                    ->orWhere('is_Chambre', $request->is_Chambre)
                    ->orWhere('is_Residence', $request->is_Residence)
                    ->orWhere('is_DUPLEX', $request->is_DUPLEX)
                    ->orWhere('is_HAUT_STANDING', 1)
                    ->orWhere('has_PISCINE', $request->has_PISCINE)
                    ->orWhere('has_GARDIEN', $request->has_GARDIEN)
                    ->orWhere('has_GARAGE', $request->has_GARAGE)
                    ->orWhere('has_balcon_avant', $request->has_balcon_avant)
                    ->orWhere('has_balcon_arriere', $request->has_balcon_arriere)
                    ->orWhere('has_COUR_AVANT',$request->has_COUR_AVANT)
                    ->orWhere('has_COUR_ARRIERE',$request->has_COUR_ARRIERE);
            })
            //->paginate('50')
            ->with('image')
            ->get();
        return view('front.maison.result_bureau', compact('data_search','cookiePassVisite'));

    }

    public function consulterLogement(Request $request, $ref)
    {
        $code = $request->code;
        //on verifie si le code existe dans notre table passvisite de la db
        $checkCode = PassVisite::where('code',$code)->where('is_expired',0)->first();
        //dd($checkCode);
        if($checkCode!=null)
        {
            $data_place = Place::where('ref',$ref)->first();
            $data = Place::findOrFail($data_place->id);
            //on verifie sil a deja consulter la maison
            $checkVisite = VisiteEffectue::where('pass_visite_id',$checkCode->id)
                ->where('place_id',$data_place->id)->first();
            //si different de null on fait rien
            if($checkVisite!=null)
            {
                $restevisite = $checkCode->nb_visite;
                $images = Image::where('place_id',$data_place->id)->get();
                return view('front.maison.show_logement',
                    compact('data','images','restevisite'));
            }
            else //sinon
            {
                //on enregistre dans la table visite effectuée
                VisiteEffectue::create(
                    [
                        'pass_visite_id'=>$checkCode->id,
                        'place_id'=>$data_place->id,
                    ]
                );
                //on decremente le nombre de pass visite
                $data_update = PassVisite::findOrFail($checkCode->id);
                $data_update->nb_visite = $data_update->nb_visite - 1;
                $data_update->save();
                $restevisite = $data_update->nb_visite;
                if($data_update->nb_visite==0)
                {
                    $data_update->is_expired=1;
                    $data_update->save();
                }
                $images = Image::where('place_id',$data_place->id)->get();
                return view('front.maison.show_logement',
                    compact('data','images','restevisite'));
            }

        }
        else
        {
            return redirect()->route('passvisite.index')->with('error','Ce code est erroné ou inactif');
        }

    }

    public function consulterBureau(Request $request, $ref)
    {

        $code = $request->code;
        //on verifie si le code existe dans notre table passvisite de la db
        $checkCode = PassVisite::where('code',$code)->where('is_expired',0)->first();
        //dd($checkCode);
        if($checkCode!=null)
        {
            $data_place = Place::where('ref',$ref)->first();
            $data = Place::findOrFail($data_place->id);
            //on verifie sil a deja consulter la maison
            $checkVisite = VisiteEffectue::where('pass_visite_id',$checkCode->id)
                ->where('place_id',$data_place->id)->first();
            //si different de null on fait rien
            if($checkVisite!=null)
            {
                $restevisite = $checkCode->nb_visite;
                $images = Image::where('place_id',$data_place->id)->get();
                return view('front.maison.show_bureau',
                    compact('data','images','restevisite'));
            }
            else //sinon
            {
                //on enregistre dans la table visite effectuée
                VisiteEffectue::create(
                    [
                        'pass_visite_id'=>$checkCode->id,
                        'place_id'=>$data_place->id,
                    ]
                );
                //on decremente le nombre de pass visite
                $data_update = PassVisite::findOrFail($checkCode->id);
                $data_update->nb_visite = $data_update->nb_visite - 1;
                $data_update->save();
                $restevisite = $data_update->nb_visite;
                if($data_update->nb_visite==0)
                {
                    $data_update->is_expired=1;
                    $data_update->save();
                }
                $images = Image::where('place_id',$data_place->id)->get();
                return view('front.maison.show_bureau',
                    compact('data','images','restevisite'));
            }

        }
        else
        {
            return redirect()->route('passvisite.index')->with('error','Ce code est erroné ou inactif');
        }

    }

    public function createCatalogue()
    {
        $communes = Commune::get();
        return view('front.maison.create_place', compact('communes'));
    }

    public function showCatalogue($ref)
    {
        $data_place = Place::where('ref',$ref)->first();
        $data = Place::findOrFail($data_place->id);
        $images = Image::where('place_id',$data_place->id)->get();
        //dd($images);
        return view('front.catalogue.show',
            compact('data','images'));
    }

    public function editStatutCatalogue(Request $request, $ref)
    {
        $data_place = Place::where('ref',$ref)->first();
        $data = Place::findOrFail($data_place->id);
        $data->is_occupe = $request->is_occupe;
        $data->save();
        return redirect()->back()->with('success','Statut mis a jour avec succès');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCatalogue(Request $request)
    {
        $couravant = $request->has_COUR_AVANT;
        $courarriere = $request->has_COUR_ARRIERE;
        $balconavant = $request->has_balcon_avant;
        $balconarriere = $request->has_balcon_arriere;
        $hasgardien = $request->has_GARDIEN;
        $hasgarage = $request->has_GARAGE;
        $haspiscine = $request->has_PISCINE;
        if ($couravant==='on')
        {
            $request->has_COUR_AVANT=1;
        }else
        {
            $request->has_COUR_AVANT=0;
        }
        if ($courarriere==='on')
        {
            $request->has_COUR_ARRIERE=1;
        }else
        {
            $request->has_COUR_ARRIERE=0;
        }
        if ($balconavant==='on')
        {
            $request->has_balcon_avant=1;
        }else
        {
            $request->has_balcon_avant=0;
        }
        if ($balconarriere==='on')
        {
            $request->has_balcon_arriere=1;
        }else
        {
            $request->has_balcon_arriere=0;
        }
        if ($hasgardien==='on')
        {
            $request->has_GARDIEN=1;
        }else
        {
            $request->has_GARDIEN=0;
        }
        if ($hasgarage==='on')
        {
            $request->has_GARAGE=1;
        }else
        {
            $request->has_GARAGE=0;
        }
        if ($haspiscine==='on')
        {
            $request->is_HAUT_STANDING=1;
            $request->has_PISCINE=1;
        }else
        {
            $request->is_HAUT_STANDING=1;
            $request->has_PISCINE=0;
        }

        switch ($request->type_maison) {
            case "0":
                $studio =1;
                $chambre = 0;
                $residence = 0;
                $appartement = 0;
                $maisonbasse = 0;
                $duplexe = 0;
                break;
            case "1":
                $studio =0;
                $chambre = 1;
                $residence = 0;
                $appartement = 0;
                $maisonbasse = 0;
                $duplexe = 0;
                break;
            case "2":
                $studio =0;
                $chambre = 0;
                $residence = 1;
                $appartement = 0;
                $maisonbasse = 0;
                $duplexe = 0;
                break;
            case "3":
                $studio =0;
                $chambre = 0;
                $residence = 0;
                $appartement = 1;
                $maisonbasse = 0;
                $duplexe = 0;
                break;
            case "4":
                $studio =0;
                $chambre = 0;
                $residence = 0;
                $appartement = 0;
                $maisonbasse = 1;
                $duplexe = 0;
                break;

            default:
                $studio =0;
                $chambre = 0;
                $residence = 0;
                $appartement = 0;
                $maisonbasse = 0;
                $duplexe = 1;

        }
        //traitement photo de couverture
        $photo_couverture=$request->file('photo_couverture');
        $photoCouvertureName=time().'.'. $photo_couverture->extension();
        $photo_couverture = $photo_couverture->move('assets/img/places', $photoCouvertureName);

        //on compte le nb d'enregistrement existant
        $count = Place::count('id');
        $data = Place::create(
            [
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'price'=>$request->price,
                'proprio_name'=>$request->proprio_name,
                'proprio_telephone'=>$request->proprio_telephone,
                'user_id'=>Auth::user()->id,
                'description'=>$request->description,
                'created_at'=>now(),
                'is_Studio'=>$studio,
                'is_Chambre'=>$chambre,
                'is_occupe'=>0,
                'is_Residence'=>$residence,
                'is_Appartment'=>$appartement,
                'is_Bureau'=>0,
                'is_MAISON_BASSE'=>$maisonbasse,
                'is_DUPLEX'=>$duplexe,
                'has_PISCINE'=>$request->has_PISCINE,
                'is_HAUT_STANDING'=>$request->is_HAUT_STANDING,
                'has_COUR_AVANT'=>$request->has_COUR_AVANT,
                'has_COUR_ARRIERE'=>$request->has_COUR_ARRIERE,
                'has_GARDIEN'=>$request->has_GARDIEN,
                'has_GARAGE'=>$request->has_GARAGE,
                'has_balcon_avant'=>$request->has_balcon_avant,
                'has_balcon_arriere'=>$request->has_balcon_arriere,
                'nombre_piece'=>$request->nombre_piece,
                'nombre_salle_eau'=>$request->nombre_salle_eau,
                'is_validated'=>0,
                'commune_id'=>$request->commune_id,
                'image_id'=>$count+1,
                'photo_couverture'=>$photo_couverture,
                'ref'=>uniqid()

            ]
        );
        //traitement des autres photo
        for($i = 1; $i < 10; $i++)
        {
            if($request->file('photo'.$i)!=null)
            {
                $photo ='photo';
                $photo =$request->file('photo'.$i);
                //dd($photo);
                $photoName=uniqid().'.'. $photo->extension();
                $photo = $photo->move('assets/img/places', $photoName);

                Image::create(
                    [
                        'place_id'=>$data->id,
                        'url'=>$photo,
                        'created_at'=>now(),
                    ]
                );
            }


        }
        if($data)
        {
            return redirect()->route('catalogue.index')->with('success','Maison enregistrée avec succès');
        }

    }

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
        $data = Place::findOrFail($id);
        $data_images = Image::where('place_id',$id)->get();
        //dd($data_images);
        return view('admin.maison.show', compact('data','data_images'));
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

    public function validateMaison($id)
    {
        $data = Place::findOrFail($id);
        $data->is_validated = 1;
        $data->save();
        return redirect()->back()->with('success','Maison validée avec succès');
    }

    public function makeOcccupe($id)
    {
        $data = Place::findOrFail($id);
        $data->is_occupe = 1;
        $data->save();
        return redirect()->back()->with('success','Le statut de la maison est désormais occupée');
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
