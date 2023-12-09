<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\About;
use App\Commune;
use App\EbankProfil;
use App\Image;
use App\InformationIdenty;
use App\PassTv;
use App\PassType;
use App\PassVisite;
use App\Place;
use App\ProgrammeTv;
use App\Transaction;
use App\TypeAbonnement;
use App\User;
use App\VisiteEffectue;
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
        if(empty($checkUser)){
            return response()->json('Le numero de telephone saisit n\'existe pas', 404);
        }
        else
        {
            if (!Hash::check($request->password, $checkUser->password))
            {
                return response()->json('Mot de passe incorrect');
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
                    //on enregistre ses data dans un cookie
                    session_start();
                    $cook = setcookie('user_phone', $request->phone);
                    //
                    if($cook)
                    {
                        return response()->json($data, 200);
                    }
                    else
                    {
                        return 'Erreur lors de la connexion';
                    }


                    $a = Place::where('user_id', '=',$checkUser->id)->get();
                    $data['places'] = $a;

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

    public function enregistrerCookieVisite()
    {
        // Crée un cookie avec une durée de vie de 60 minutes
        $cookie = cookie('code_passvisite', 'valeur_du_cookie', 60);

        // Ajoute le cookie à la réponse
        return response('Informations enregistrées dans le cookie')->cookie($cookie);
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


    public function buyPassVisite(Request $request)
    {
        // recupère les données pour la transaction (transaction_number, amount, transaction_way, transaction_type, operation_id ) et le type de pass depuis l'utilisateur

        // vérification au près de cinetpay de la transaction
        $isPayed = true;
        // $isPayed = $this->checkStatutTransactions($request->transaction_number, $request->amount);

        // si la transaction est validé, créer la transaction et le pass
        if($isPayed){
            //succes
            //on enregistre la transaction
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
            //on recupere le type de passe
            $data_type_pass = PassType::findOrFail($request->pass_type_id);
            $passvisite = PassVisite::create(
                [
                    'transaction_number'=>$request->transaction_number,
                    'code'=>substr($uniqid, 0, 8),
                    'end_date'=>date('Y-m-d', strtotime(' + 7 days')),
                    'nb_visite'=>$data_type_pass->nb_visite,
                    'is_expired'=>0,
                    'is_confirmed'=>1,
                    'pass_type_id'=>$data_type_pass->id,
                    'transaction_id'=>$transaction->id,
                    'created_at'=>now(),

                ]
            );

            $data['transaction'] = $transaction;
            $data['passvisite'] = $passvisite;

            return response()->json($data);

        }
        else
        {
            return 'Ce payement n\'a pas été reconnu';
        }

    }



}
