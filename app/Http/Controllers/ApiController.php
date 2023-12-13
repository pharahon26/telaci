<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\About;
use App\Models\Commune;
use App\Models\EbankProfil;
use App\Models\Image;
use App\Models\InformationIdenty;
use App\Models\PassTv;
use App\Models\PassType;
use App\Models\PassVisite;
use App\Models\Place;
use App\Models\ProgrammeTv;
use App\Models\Transaction;
use App\Models\TypeAbonnement;
use App\Models\User;
use App\Models\VisiteEffectue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    public function test()
    {
        $tableau = array();
        // Ajouter une valeur au tableau
        for ($j=0; $j < 2; $j++) {
            array_push($tableau, $j.'.'.'jpg,');
        }
        $string = implode("",$tableau);
        dd($string);
    }

    //AUTHENTIFICATION
    public function login(Request $request){

        $checkUser = User::where('phone', $request->phone)->first();
        if($checkUser == null){
            return response()->json('Mot de passe ou numero de téléphone incorrect', 404);
        }
        else
        {
            if (!Hash::check($request->password, $checkUser->password))
            {
                return response()->json('Mot de passe ou numero de téléphone incorrect', 404);
            }
            else
            {
                $credentials = $request->only('phone', 'password');
                $login = Auth::attempt($credentials);
                $data['user'] = $checkUser;
                if($login)
                {
                    /*if($checkUser->is_demarcheur == 1){
                        $d = Demarcheur::where('user_id', '=',$checkUser->id)->get()->first();
                        $data['demarcheur'] = $d;
                    }*/

                    $dayAfter = (now())->format('Y-m-d');
                    $a = Abonnement::where('user_id', '=',$checkUser->id)->where('end_date', '>', $dayAfter)->get();
                    $data['abonnement'] = $a;
                    //     $dayAfter = (now())->format('Y-m-d');
                    //     $query->where('end_date', '<', $dayAfter);
                    //on enregistre ses data dans un cookie*
                    
                    $a = Place::where('user_id', '=',$checkUser->id)->get();
                    $data['places'] = $a;
                    $ident = InformationIdenty::where('user_id', '=',$checkUser->id)->get()->first();
                    $eb = EbankProfil::where('information_identity_id', '=',$ident->id)->get()->first();
                    if($eb){
                        $data['ebank'] = $eb;
                        $data['epargne'] = $eb->epargne();

                    }

                    return response()->json($data, 200);
                }
                else
                {
                    return response()->json('Les parametres sont incorrects', 404);
                }
            }
        }

        /*if(empty($user)){
            return response()->json(false, 422);
        }else{

            return response()->json($user, 200);
        }*/

    }

    //String vers json
    public function getStringToJson(Request $request)
    {
        // Vérifie si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère les données du corps de la requête
            $data = file_get_contents('php://input');

            // Décode les données JSON en tableau associatif
            $inputData = json_decode($data, true);

            // Vérifie si le champ 'input' est présent dans les données
            if (isset($inputData['input'])) {
                // Récupère la chaîne d'entrée
                $inputString = $inputData['input'];

                // Effectue la conversion en JSON
                $outputArray = array('output' => json_encode($inputString));

                // Retourne le résultat en format JSON
                return json_encode($outputArray);
            } else {
                // Retourne une réponse d'erreur si le champ 'input' est manquant
                return json_encode(array('error' => 'Le champ "input" est requis.'));
            }
        } else {
            // Retourne une réponse d'erreur si la méthode HTTP n'est pas POST
            return json_encode(array('error' => 'La méthode HTTP doit être POST.'));
        }
    }
    //json vers string
    public function getJsonToString(Request $request)
    {
        // Vérifie si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère les données du corps de la requête
            $data = file_get_contents('php://input');

            // Décode les données JSON en tableau associatif
            $inputData = json_decode($data, true);

            // Vérifie si le champ 'input' est présent dans les données
            if (isset($inputData['input'])) {
                // Récupère la valeur associée à la clé 'input'
                $inputString = $inputData['input'];

                // Retourne le résultat sous forme de chaîne de caractères
                return json_encode(array('output' => (string) $inputString));
            } else {
                // Retourne une réponse d'erreur si le champ 'input' est manquant
                return json_encode(array('error' => 'Le champ "input" est requis.'));
            }
        } else {
            // Retourne une réponse d'erreur si la méthode HTTP n'est pas POST
            return json_encode(array('error' => 'La méthode HTTP doit être POST.'));
        }
    }

    public function getCookies(Request $request)
    {
        session_start();
        $cookie = $_COOKIE['user_phone'];
        $datas = false;
        if($request->user_phone==$cookie)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //GESTION DES COMMUNES
    public function getAllCommunes()
    {
        $datas = Commune::get();
        return response()->json($datas);
    }

    public function addCommune(Request $request)
    {
        $data = Commune::create(
            [
                'name'=>$request->name,
            ]
        );

        return response()->json($data);
    }

    public function showCommune($id)
    {
        $data = Commune::findOrFail($id);
        return response()->json($data);
    }

    public function updateCommune(Request $request, $id)
    {
        $data = Commune::findOrFail($id);
        $data->name = $request->name;
        $data->save();
        return response()->json($data);
    }

    public function deleteCommune(Request $request, $id)
    {
        $data = Commune::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

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
        //return response()->json($data);
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

    //GESTION DES USERS
    public function getAllUsers()
    {
        $datas = User::with('demarcheur')->get();
        return response()->json($datas);
    }

    public function addUser(Request $request)
    {
        $name = $request->nom .' '.$request->prenoms;
        $is_demarcheur = $request->is_demarcheur;
        $data = User::create(
            [
                'nom'=>$request->nom,
                'prenoms'=>$request->prenoms,
                'name'=>$name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'created_at'=>now(),
                'is_demarcheur'=>$is_demarcheur,
                'password'=>Hash::make($request->password),
            ]
        );
        //on verifie si c'est un demarcheur alors on enregistre dans la table demarcheur
        if($is_demarcheur==1)
        {
             $d = Demarcheur::create(
                [
                    'user_id'=>$data->id,
                    //'type_abonnement_id'=>$request->type_abonnement_id,
                    'balance'=>0,
                    'is_suspended'=>false,
                    'is_validated'=>false,
                    'created_at'=>now(),
                ]
            );

            $data['demarcheur'] = $d;

            //on crée en meme temps son compte e-banking
            EbankProfil::create(
                [
                    'balance'=>0,
                    'created_at'=>now(),
                    'user_id'=>$data->id,
                ]);
        }

        $dayAfter = (now())->format('Y-m-d');
        $a = Abonnement::where('user_id', '=',$data->id)->where('end_date', '>', $dayAfter)->get();
        $data['abonnement'] = $a;

        // $ab1 = $data->hasOne(Abonnement::class)->latestOfMany();

        // $data['ab'] = $ab;
        // $data['ab1'] = $ab1;

    }

    public function showUser($id)
    {
        $data = User::findOrFail($id);
        return response()->json($data);
    }

    public function updateUser(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->nom = $request->nom;
        $data->prenoms = $request->prenoms;
        $data->name = $request->nom . ' '. $request->prenoms;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->is_staff = $request->is_staff;
        $data->is_demarcheur = $request->is_demarcheur;
        $data->is_suspended = $request->is_suspended;
        $data->password = Hash::make($request->password);
        $data->remember_password = $request->password;
        $data->updated_at = now();
        $data->save();
        //return response()->json($data);
    }

    public function deleteUser(Request $request, $id)
    {
        $data = User::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    //GESTION DES DEMARCHEURS
    public function getAllDemarcheurs()
    {
        $datas = Demarcheur::with('place','user')->get();
        return response()->json($datas);
    }

    public function addDemarcheur(Request $request)
    {
        $data = Demarcheur::create(
            [
                'user_id'=>$request->user_id,
                'balance'=>$request->balance,
                'is_suspended'=>$request->is_suspended,
                'is_validated'=>$request->is_validated,
                'created_at'=>now(),

            ]
        );

        //return response()->json($data);
    }

    public function showDemarcheur($id)
    {
        $data = Demarcheur::findOrFail($id);
        return response()->json($data);
    }

    public function updateDemarcheur(Request $request, $id)
    {
        $data = Demarcheur::findOrFail($id);
        $data->user_id = $request->user_id;
        $data->balance = $request->balance;
        $data->is_suspended = $request->is_suspended;
        $data->is_validated = $request->is_validated;
        $data->updated_at = now();
        $data->save();
        //return response()->json($data);
    }

    public function deleteDemarcheur(Request $request, $id)
    {
        $data = Demarcheur::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    //GESTION DES MAISONS
    public function getAllPlaces()
    {
        $datas = Place::with('image')->get();
        return response()->json($datas);
    }

    public function searchPlace(Request $request)
    {
        $datas = Place::where('commune_id',$request->commune_id)
            ->where('is_validated',1)
            ->where('nombre_piece',$request->nombre_piece)
            ->where('nombre_salle_eau',$request->nombre_salle_eau)
            ->where('is_Bureau',0)
            ->where('has_COUR_AVANT',$request->has_COUR_AVANT)
            ->where('has_COUR_ARRIERE',$request->has_COUR_ARRIERE)
            ->where(function ($query) use ($request) {
                $query->orWhere('is_Appartment', $request->is_Appartment)
                    ->orWhere('is_MAISON_BASSE', $request->is_MAISON_BASSE)
                    ->orWhere('is_DUPLEX', $request->is_DUPLEX)
                    ->orWhere('is_HAUT_STANDING', $request->is_HAUT_STANDING)
                    ->orWhere('has_PISCINE', $request->has_PISCINE)
                    ->orWhere('has_GARDIEN', $request->has_GARDIEN)
                    ->orWhere('has_GARAGE', $request->has_GARAGE)
                    ->orWhere('has_balcon_avant', $request->has_balcon_avant)
                    ->orWhere('has_balcon_arriere', $request->has_balcon_arriere);
            })
            ->with('image')
            ->get();
        return response()->json($datas);
    }

    public function searchBureau(Request $request)
    {
        $datas = Place::where('commune_id',$request->commune_id)
                ->where('is_validated',1)
                ->where('nombre_piece',$request->nombre_piece)
                ->where('nombre_salle_eau',$request->nombre_salle_eau)
                ->where('is_Bureau',1)
                ->where('has_COUR_AVANT',$request->has_COUR_AVANT)
                ->where('has_COUR_ARRIERE',$request->has_COUR_ARRIERE)
                ->where(function ($query) use ($request) {
                    $query->orWhere('is_Appartment', $request->is_Appartment)
                        ->orWhere('is_MAISON_BASSE', $request->is_MAISON_BASSE)
                        ->orWhere('is_DUPLEX', $request->is_DUPLEX)
                        ->orWhere('is_HAUT_STANDING', $request->is_HAUT_STANDING)
                        ->orWhere('has_PISCINE', $request->has_PISCINE)
                        ->orWhere('has_GARDIEN', $request->has_GARDIEN)
                        ->orWhere('has_GARAGE', $request->has_GARAGE)
                        ->orWhere('has_balcon_avant', $request->has_balcon_avant)
                        ->orWhere('has_balcon_arriere', $request->has_balcon_arriere);
                })
            ->with('image')
            ->get();
        return response()->json($datas);
    }

    public function addPlace(Request $request)
    {
        //on compte le nb d'enregistrement existant
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

            ]
        );
        //on enregistre dans la table image la photo
        //traitement image
        $arrImg = $request->images;
        foreach ($arrImg as $imgeA) {
            $image=$imgeA;

            if($image!=null)
            {
                $imageName=$image;
                $image = $this->savePicture($imageName, ('assets/img/places/'.rand(1,9999999999999999).'.jpg'));
                $img = Image::create(
                    [
                        'place_id'=>$data->id,
                        'url'=>$image,
                        'created_at'=>now(),
                    ]
                );
                if ($i = 0) {
                    $data->image_id = $img->id;
                    $data->save();
                }
            }
            else
            {
                $imageName=null;
                $image=null;
            }

        }
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
        $data->commune_id=$request->commune_id;
        $data->updated_at = now();
        $data->save();
        //return response()->json($data);
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

    //GESTION DES ABONNEMENTS
    public function getAllAbonnements()
    {
        $datas = Abonnement::get();
        return response()->json($datas);
    }

    public function addAbonnement(Request $request)
    {
        $data = Abonnement::create(
            [
                'type'=>$request->type,
                'type_abonnement_id'=>$request->type_abonnement_id,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'transaction_id'=>$request->transaction_id,
                'created_at'=>now(),
                'user_id'=>$request->user_id,
            ]
        );

        //return response()->json($data);
    }

    public function showAbonnement($id)
    {
        $data = Abonnement::findOrFail($id);
        return response()->json($data);
    }

    public function updateAbonnement(Request $request, $id)
    {
        $data = Abonnement::findOrFail($id);
        $data->type = $request->type;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->transaction_id = $request->transaction_id;
        $data->user_id = $request->user_id;
        $data->is_actif = $request->is_actif;
        $data->updated_at = now();
        $data->save();
        //return response()->json($data);
    }

    public function deleteAbonnement(Request $request, $id)
    {
        $data = Abonnement::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    //GESTION DES TRANSACTIONS
    public function getAllTransactions()
    {
        $datas = Transaction::get();
        return response()->json($datas);
    }

    public function addTransaction(Request $request)
    {
        $data = Transaction::create(
            [
                'transaction_number'=>$request->transaction_number,
                'date_transaction'=>now(),
                'amount'=>$request->amount,
                'transaction_way'=>$request->transaction_way,
                'transaction_type'=>$request->transaction_type,
                'created_at'=>now(),
                'user_id'=>$request->user_id,
            ]
        );

        //return response()->json($data);
    }

    public function buyAbonement(Request $request)
    {
        $transaction = Transaction::create(
            [
                'transaction_number'=>$request->transaction_number,
                'date_transaction'=>now(),
                'amount'=>$request->amount,
                'transaction_way'=>$request->transaction_way,
                'transaction_type'=>$request->transaction_type,
                'operation_id'=>$request->operation_id,
                'created_at'=>now(),
                'user_id'=>$request->user_id,
            ]
        );

        $abonnement = Abonnement::create(
            [
                'type'=>$request->type,
                'type_abonnement_id'=>$request->type_abonnement_id,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'transaction_id'=>$transaction->id,
                'created_at'=>now(),
                'user_id'=>$request->user_id,
            ]
        );
        $data['transaction'] = $transaction;
        $data['abonnement'] = $abonnement;


        return response()->json($data);
    }

    public function showTransaction($id)
    {
        $data = Transaction::findOrFail($id);
        return response()->json($data);
    }

    public function updateTransaction(Request $request, $id)
    {
        $data = Transaction::findOrFail($id);
        $data->transaction_number = $request->transaction_number;
        $data->date_transaction = now();
        $data->amount = $request->amount;
        $data->transaction_way = $request->transaction_way;
        $data->user_id = $request->user_id;
        $data->transaction_type = $request->transaction_type;
        $data->updated_at = now();
        $data->save();
        //return response()->json($data);
    }

    //GESTION DES PROFIL EBANKING
    public function getAllEbankingProfils()
    {
        $datas = EbankProfil::get();
        return response()->json($datas);
    }

    public function addEbankingProfil(Request $request)
    {
         EbankProfil::create(
            [
                'balance'=>$request->balance,
                'created_at'=>now(),
                'user_id'=>$request->user_id,
            ]
        );

        //return response()->json($data);
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
        $data->user_id = $request->user_id;
        $data->updated_at = now();
        $data->save();
        //return response()->json($data);
    }

    public function deleteEbankingProfil(Request $request, $id)
    {
        $data = EbankProfil::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

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

        //return response()->json($data);
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
        //return response()->json($data);
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

    //GESTION DES IMAGES
    public function getAllImages()
    {
        $datas = Image::get();
        return response()->json($datas);
    }

    public function addImage(Request $request)
    {
        $data = Image::create(
            [
                'url'=>$request->url,
                'place_id'=>$request->place_id,
                'created_at'=>now(),
            ]
        );

        return response()->json($data);
    }

    public function showImage($id)
    {
        $data = Image::findOrFail($id);
        return response()->json($data);
    }

    public function updateImage(Request $request, $id)
    {
        $data = Image::findOrFail($id);
        $data->url = $request->url;
        $data->place_id = $request->place_id;
        $data->updated_at = now();
        $data->save();
        return response()->json($data);
    }

    public function deleteImage(Request $request, $id)
    {
        $data = Image::where('id',$id)->delete();
        if($data)
        {
            return 'Suppression ok';
        }
        else
        {
            return 'Une erreur est survenue';
        }

    }

    //GESTION ABOUT
    public function showAbout()
    {
        $data = About::first();
        return response()->json($data);
    }

    //GESTION CINETPAY
    public function notifyPaiement(Request $request){

        if ($request->cpm_result == '00'){

            return 'succes de la transaction';
        }else{
            return 'echec de la transaction';
        }
    }


    private function savePicture($base64_string, $output_file) {
        $dirPlace = 'assets/img/places/';
        $dirPhoto = 'assets/img/users/photo/';
        $dirPieces = 'assets/img/users/pieces/';
        if(!is_dir($dirPlace)){
            mkdir( $dirPlace , 0755, true);
        }
        if(!is_dir($dirPhoto)){
            mkdir( $dirPhoto , 0755, true);
        }
        if(!is_dir($dirPieces)){
            mkdir( $dirPieces , 0755, true);
        }
        // chdir($old.$path_to_file);
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        // $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $base64_string ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }


}
