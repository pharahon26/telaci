<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\EbankProfil;
use App\InformationIdenty;
use App\Place;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    //GESTION DES USERS INSCRIPTION
    public function getAllUsers()
    {
        $datas = InformationIdenty::get();
        return response()->json($datas);
    }

    public function addUser(Request $request)
    {
        $name = $request->nom .' '.$request->prenoms;
        $is_demarcheur = $request->is_demarcheur;
        if($is_demarcheur==true)
        {
            $is_demarcheur = 1;
        }
        else
        {
            $is_demarcheur = 0;
        }

        $photo=$request->photo;
        if($photo!=null)
        {
            $imageName=$photo;
            $photo = $this->savePicture($imageName, ('assets/img/users/photo/'.rand(1,9999999999999999).'.jpg'));
        }

        $checkUser = User::where('phone', $request->phone)->first();
        if($checkUser){
            return response()->json('Le numero de telephone saisit existe deja', 404);
        }
        else
        {
            $data = User::create(
                [
                    'nom'=>$request->nom,
                    'prenoms'=>$request->prenoms,
                    'name'=>$name,
                    'email'=>$request->email,
                    'photo_profil'=>$photo,
                    'phone'=>$request->phone,
                    'created_at'=>now(),
                    'is_demarcheur'=>$is_demarcheur,
                    'password'=>Hash::make($request->password),
                    'is_validated'=>false,
                    'balance'=>0,
                    'is_suspended'=>false,
                ]
            );

            //on cree son profil
            $identity = InformationIdenty::create(
                [
                    'name'=>$data->name,
                    'photo'=>$photo,
                    'phone1'=>$data->phone,
                    'created_at'=>now(),
                    'user_id'=>$data->id,
                    'is_validated'=>0
                ]);
            //on crée en meme temps son compte e-banking
            EbankProfil::create(
                [
                    'balance'=>0,
                    'created_at'=>now(),
                    'information_identity_id'=>$identity->id,
                ]);


            $dayAfter = (now())->format('Y-m-d');
            $a = Abonnement::where('user_id', '=',$data->id)->where('end_date', '>', $dayAfter)->get();
            $data['abonnement'] = $a;
            $data['identity'] = $identity;
            // $ab1 = $data->hasOne(Abonnement::class)->latestOfMany();

            // $data['ab'] = $ab;
            // $data['ab1'] = $ab1;
            if($data)
            {
                return response()->json($data);
            }
            else
            {
                return response()->json('Une erreur est survenue');
            }
        }

    }

    public function addUserFromMobileApp(Request $request)
    {
        $name = $request->nom .' '.$request->prenoms;
        $is_demarcheur = $request->is_demarcheur;
        $photo=$request->photo;
        if($photo!=null)
        {
            $imageName=$photo;
            $photo = $this->savePicture($imageName, ('assets/img/users/photo/'.rand(1,9999999999999999).'.jpg'));
        }

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
                'is_validated'=>false,
                'balance'=>0,
                'is_suspended'=>false,
            ]
        );

        //on cree son profil
        InformationIdenty::create(
            [
                'name'=>$data->name,
                'photo'=>$photo,
                'phone1'=>$data->phone,
                'created_at'=>now(),
                'user_id'=>$data->id,
                'is_validated'=>0
            ]);
        //on crée en meme temps son compte e-banking
        EbankProfil::create(
            [
                'balance'=>0,
                'created_at'=>now(),
                'information_identity_id'=>$data->id,
            ]);


        $dayAfter = (now())->format('Y-m-d');
        $a = Abonnement::where('user_id', '=',$data->id)->where('end_date', '>', $dayAfter)->get();
        $data['abonnement'] = $a;

        // $ab1 = $data->hasOne(Abonnement::class)->latestOfMany();

        // $data['ab'] = $ab;
        // $data['ab1'] = $ab1;

        return response()->json($data);
    }

    public function showUser($id)
    {
        $data = InformationIdenty::findOrFail($id);
        return response()->json($data);
    }

    /*    public function updateUser(Request $request, $id)
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
            $data->is_validated = $request->is_validated;
            $data->password = Hash::make($request->password);
            $data->remember_password = $request->password;
            $data->updated_at = now();
            $data->save();
            return response()->json($data);
        }*/

    public function updateUserProfil(Request $request)
    {
        $cni_recto=$request->cni_recto;
        $cni_verso=$request->cni_verso;
        $photo=$request->photo;

        if($cni_recto!=null)
        {
            $imageName=$cni_recto;
            $cni_recto = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }
        if($cni_verso!=null)
        {
            $imageName=$cni_verso;
            $cni_verso = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }


        $id = $request->id;

        $dataInfo = InformationIdenty::where('user_id',$id)->first();
        $data = InformationIdenty::findOrFail($dataInfo->id);
        $data->name = $request->name;
        $data->genre = $request->genre;
        $data->phone1 = $request->phone1;
        $data->phone2 = $request->phone2;
        $data->lieu_naissance = $request->lieu_naissance;
        $data->date_naissance = $request->date_naissance;
        $data->nationalite = $request->nationalite;
        //$data->pays = $request->pays;
        $data->domicile = $request->domicile;
        $data->cni_recto = $cni_recto;
        $data->cni_verso = $cni_verso;
        $data->numero_cni = $request->numero_cni;
        $data->updated_at = now();
        $data->save();

        //on update les datas dans la table user
        $dataUser = User::findOrFail($id);
        $dataUser->name = $request->name;
        $dataUser->phone = $request->phone1;
        $dataUser->is_completed = 1;
        $dataUser->save();

        return response()->json($data);
    }

    public function updateUserProfilBackup(Request $request)
    {
        $cni_recto=$request->cni_recto;
        $cni_verso=$request->cni_verso;
        $photo=$request->photo;

        if($cni_recto!=null)
        {
            $imageName=$cni_recto;
            $cni_recto = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }
        if($cni_verso!=null)
        {
            $imageName=$cni_verso;
            $cni_verso = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }


        $id = $request->id;
        $data = InformationIdenty::where('user_id', '=',$id)->first();
        $data->name = $request->name;
        $data->genre = $request->genre;
        $data->phone1 = $request->phone1;
        $data->phone2 = $request->phone2;
        $data->lieu_naissance = $request->lieu_naissance;
        $data->date_naissance = $request->date_naissance;
        $data->nationalite = $request->nationalite;
        $data->pays = $request->pays;
        $data->domicile = $request->domicile;
        $data->cni_recto = $cni_recto;
        $data->cni_verso = $cni_verso;
        $data->numero_cni = $request->numero_cni;
        $data->updated_at = now();
        $data->save();
        return response()->json($data);
    }

    public function updateUserProfilFromPhone(Request $request)
    {
        /*$cni_recto=$request->cni_recto;
        $cni_verso=$request->cni_verso;
        $photo=$request->photo;

        if($cni_recto!=null)
        {
            $imageName=$cni_recto;
            $cni_recto = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }
        if($cni_verso!=null)
        {
            $imageName=$cni_verso;
            $cni_verso = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }
        if($photo!=null)
        {
            $imageName=$photo;
            $photo = $this->savePicture($imageName, ('assets/img/users/photo/'.rand(1,9999999999999999).'.jpg'));
        }*/
        $id = $request->id;
        $data = InformationIdenty::where('user_id', '=',$id)->first();

        $data->name = $request->name;
        $data->genre = $request->genre;
        $data->phone1 = $request->phone1;
        $data->phone2 = $request->phone2;
        $data->lieu_naissance = $request->lieu_naissance;
        $data->date_naissance = $request->date_naissance;
        $data->nationalite = $request->nationalite;
        $data->pays = $request->pays;
        $data->domicile = $request->domicile;
        /*$data->cni_recto = $cni_recto;
        $data->cni_verso = $cni_verso;
        $data->photo = $photo;*/
        $data->updated_at = now();
        $data->save();
        return response()->json($data);
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

    public function index()
    {
        $datas = InformationIdenty::get();
        return view('admin.inscription.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('front.inscription.create_identification');
    }

    public function login(Request $request)
    {
        // Récupère la valeur du cookie
        //$cookie = $request->cookie('phone_number');
        //dd($cookie);
        return view('front.inscription.login');
    }

    public function connexion(Request $request)
    {
        $checkUser = User::where('phone', $request->phone)->first();
        if(empty($checkUser)){
            return back()->withInput()->with('error','Le numero saisit n\'existe pas');
        }
        elseif(!empty($checkUser))
        {
            if (!Hash::check($request->password, $checkUser->password))
            {
                return back()->withInput()->with('error','Mot de passe incorrect');
            }
            else
            {
                $credentials = $request->only('phone', 'password');
                $login = Auth::attempt($credentials);
                if($login)
                {
                    $dayAfter = (now())->format('Y-m-d');
                    $data = Abonnement::where('user_id', '=',$checkUser->id)->where('end_date', '>', $dayAfter)->get();
                    return redirect()->route('profil.index', compact('data'));
                }
                else
                {
                    return back()->with('error','Les parametres sont incorrects');
                }
            }
        }

    }

    public function indexProfil (Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $abonnements = Abonnement::where('user_id',$auth_user_id)
            ->where('is_actif',1)->get();

        return view('front.inscription.profil', compact('abonnements'));
    }

    public function editProfil($id)
    {
        if(\auth()->user()->id != $id)
        {
            return redirect()->back()->with('danger','Vous n\'etes pas autorisé à acceder à cette page');
        }
        else
        {
            $check = InformationIdenty::where('user_id',$id)->first();
            $dataProfil = InformationIdenty::findOrFail($check->id);
            return view('front.inscription.edit_profil', compact('dataProfil'));

        }
    }

    public function updateProfil(Request $request, $id)
    {
        $id = Auth::user()->id;
        //dd($id);
        $cni_recto=$request->file('cni_recto');
        $cniRectoName=uniqid().'.'. $cni_recto->extension();
        $cni_recto = $cni_recto->move('assets/img/users/pieces', $cniRectoName);

        $cni_verso=$request->file('cni_verso');
        $cniVersoName=uniqid().'.'. $cni_verso->extension();
        $cni_verso = $cni_verso->move('assets/img/users/pieces', $cniVersoName);
        //on update les info dans la table informationIdentity
        $dataInfo = InformationIdenty::where('user_id',$id)->first();
        $data = InformationIdenty::findOrFail($dataInfo->id);
        //dd($data);
        $data->name = $request->name;
        $data->genre = $request->genre;
        $data->phone1 = $request->phone;
        $data->phone2 = $request->phone2;
        $data->lieu_naissance = $request->lieu_naissance;
        $data->date_naissance = $request->date_naissance;
        $data->nationalite = $request->nationalite;
        //$data->pays = $request->pays;
        $data->domicile = $request->domicile;
        $data->cni_recto = $cni_recto;
        $data->cni_verso = $cni_verso;
        $data->numero_cni = $request->numero_cni;
        $data->updated_at = now();
        $data->save();
        //on update les datas dans la table user
        $dataUser = User::findOrFail($id);
        $dataUser->name = $request->name;
        $dataUser->phone = $request->phone;
        $dataUser->is_completed = 1;
        $dataUser->save();

        return redirect()->route('profil.index')->with('success','Profil mis à jour avec succès');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $chechPhoneNumber = Validator::make($request->all(),
            [
                'phone1'=>'unique:information_identies'
            ]);
        $validatorPassword = Validator::make($request->all(),
            [
                'password'=>'confirmed'
            ]);


        if($request->accepter!='on')
        {
            return back()->withInput()->with('error','Veuillez accepter nos conditions d\'utilisation');
        }
        if($chechPhoneNumber->fails())
        {
            return back()->withInput()->with('error','Cet numero de télephone appartient dèja
             à un autre utilisateur!');
        }
        elseif($validatorPassword->fails())
        {
            return back()->withInput()->with('error','Les 2 mots de passe ne correspondent pas');
        }
        else
        {
            $photo=$request->photo;
            $photoName=time().'.'. $photo->extension();
            $photo = $photo->move('assets/img/users/photo', $photoName);
            $data = User::create(
                [
                    'name'=>$request->name,
                    'photo_profil'=>$photo,
                    'phone'=>$request->phone,
                    'created_at'=>now(),
                    'is_demarcheur'=>1,
                    'password'=>Hash::make($request->password),
                    'is_validated'=>false,
                    'balance'=>0,
                    'is_suspended'=>false,
                ]
            );

            //on cree son profil
            $identity = InformationIdenty::create(
                [
                    'name'=>$data->name,
                    'photo'=>$photo,
                    'phone1'=>$data->phone,
                    'created_at'=>now(),
                    'user_id'=>$data->id,
                    'is_validated'=>0
                ]);
            //on crée en meme temps son compte e-banking
            EbankProfil::create(
                [
                    'balance'=>0,
                    'created_at'=>now(),
                    'information_identity_id'=>$identity->id,
                ]);
            //on enregistre dans les cookies
            $cookie = cookie('phone_number', $request->phone, 2);
            //dd($cookie);
            //redirection
            return redirect()->route('login.index')->with('success',
                'Votre profil a été crée avec succès, veuillez vous connecter maintenant')->cookie($cookie);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = InformationIdenty::findOrFail($id);
        return view('admin.inscription.show', compact('data'));
    }

    public function showProfil($id)
    {
        $auth = Auth::user()->id;
        $profil = InformationIdenty::where('user_id',$auth)->first();
        $data = InformationIdenty::findOrFail($profil->id);

        return view('front.inscription.show', compact('data'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validateInscription($id)
    {
        $data = InformationIdenty::findOrFail($id);
        //on recupere les info dans la table users
        $data_user = User::findOrFail($data->user_id);
        $data->is_validated = 1;
        $data->save();
        //on update en meme temps les info dans la table user
        $data_user->is_validated = 1;
        $data_user->save();
        $user_places = Place::where('user_id',$data->user_id)->get();
        foreach ($user_places as $item)
        {
            if($item->is_validated==false)
            {
                $item->is_validated =true;
                $item->save();
            }
        }

        /*$token = $this->getLoginToken();
        $this->addNumber($data->phone1,225,$token,'', $data->name);*/
        return redirect()->back()->with('success','Inscription validée avec succès');
    }

    public function validateInscriptionWithAbonnemnt(Request $request, $id)
    {
        $data = InformationIdenty::findOrFail($id);
        //on recupere les info dans la table users
        $data_user = User::findOrFail($data->user_id);
        $data->is_validated = 1;
        $data->save();
        //on update en meme temps les info dans la table user
        $data_user->is_validated = 1;
        $data_user->save();
        //on enregistre son abonnement pour 1 mois
        //on save la transaction
        $transaction = Transaction::create(
            [
                'transaction_number'=>'Promo',
                'date_transaction'=>now(),
                'amount'=>0,
                'transaction_way'=>'Tela',
                'transaction_type'=>'Tela Promo',
                'operation_id'=>'Tela',
                'created_at'=>now(),
            ]
        );
        //on enregistre labonnement
        $uniqid = uniqid();
        $abonnement = Abonnement::create(
            [
                'type'=>'Promo',
                'type_abonnement_id'=>1,
                'start_date'=>now(),
                'end_date'=>date('Y-m-d', strtotime(' + 1 month')),
                'transaction_id'=>1,
                'created_at'=>now(),
                'user_id'=>$data->user_id,
                'is_actif'=>1
            ]
        );
        $user_places = Place::where('user_id',$data->user_id)->get();
        foreach ($user_places as $item)
        {
            if($item->is_validated==false)
            {
                $item->is_validated =true;
                $item->save();
            }
        }

        /*$token = $this->getLoginToken();
        $this->addNumber($data->phone1,225,$token,'', $data->name);*/

        return redirect()->back()->with('success','Inscription validée avec succès');
    }

    public function getLoginToken()
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::asForm()->post('https://client.cinetpay.com/v1/auth/login',[
            'apikey ' => '412126359654bb6ed651509.14435556',
            'password ' => '5865665',
        ]);

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '0') {
            return $jsonData->data->token;
        } else {
            return '';
        }

    }

    // ajouter numero 0 la liste de contacts CINET_PAY
    public function addNumber($phone, $prefix='225', $token, $mail='', $name)
    {
        /// fonction pour vérifier si le payement a bien été effectué au niveau de cinetpay

        $response = Http::withToken($token)->post('https://client.cinetpay.com/v1/transfer/contact',[
            "prefix"=> $prefix,
            "phone" => $phone,
            "name" => $name,
            "surname" => $name,
            "email" => $mail
        ] );

        $jsonData = $response->json();

        /// on verifier que le payement est réussi et la some est bonne
        if ($jsonData->code == '0') {
            return true;
        } else {
            return false;
        }

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
