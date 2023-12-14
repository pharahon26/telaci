<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\EbankProfil;
use App\Models\InformationIdenty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        $checkUser = User::where('phone', $request->phone)->first();
        if($checkUser){
            return response()->json('Le numero de telephone saisit existe deja', 404);
        }
        $name = $request->nom .' '.$request->prenoms;
        $is_demarcheur = $request->is_demarcheur;


        $photo=$request->photo;

        if($photo!=null)
        {
            $imageName=$photo;
            $photo = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        }


        $profil = User::create(
            [
                'nom'=>$request->nom,
                'prenoms'=>$request->prenoms,
                'name'=>$name,
                'photo_profil'=>$photo,
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
        $identity = InformationIdenty::create(
            [
                'name'=>$profil->name,
                'photo'=>$photo,
                // 'photo'=>$photoName,
                'phone1'=>$profil->phone,
                'created_at'=>now(),
                'user_id'=>$profil->id,
                'is_validated'=>0
            ]);
        // //on crée en meme temps son compte e-banking
        $ebank = EbankProfil::create(
            [
                'nom'=>$request->nom,
                'prenoms'=>$request->prenoms,
                'balance'=>0,
                'photo'=>$photo,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'is_demarcheur'=>true,
                'password'=>Hash::make($request->password),
                'created_at'=>now(),
                'information_identity_id'=>$identity->id,
            ]);


        if($profil)
        {
            $data['profil'] = $profil;
            $data['ebank'] = $ebank;
            return response()->json($data);
        }
        else
        {
            return response()->json('Une erreur est survenue');
        }
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
        // $cni_recto=$request->cni_recto;
        // $cni_verso=$request->cni_verso;
        // $photo=$request->photo;

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

        // if($cni_recto!=null)
        // {
        //     $imageName=$cni_recto;
        //     $cni_recto = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        // }
        // if($cni_verso!=null)
        // {
        //     $imageName=$cni_verso;
        //     $cni_verso = $this->savePicture($imageName, ('assets/img/users/pieces/'.rand(1,9999999999999999).'.jpg'));
        // }
        // if($photo!=null)
        // {
        //     $imageName=$photo;
        //     $photo = $this->savePicture($imageName, ('assets/img/users/photo/'.rand(1,9999999999999999).'.jpg'));
        // }
        // $id = 1;
        $id = $request->id;
        // $data = InformationIdenty::findOrFail($id);

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
        // $data->cni_recto = $cni_recto;
        // $data->cni_verso = $cni_verso;
        // $data->photo = $photo;
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

    public function login()
    {
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
        $nom = $request->nom;
        $prenom = $request->prenom;
        $name = $nom .' '.$prenom;
        $id = Auth::user()->id;
        $cni_recto=$request->file('cni_recto');
        $cniRectoName=uniqid().'.'. $cni_recto->extension();
        $cni_recto = $cni_recto->move('assets/img/users/pieces', $cniRectoName);

        $cni_verso=$request->file('cni_verso');
        $cniVersoName=uniqid().'.'. $cni_verso->extension();
        $cni_verso = $cni_verso->move('assets/img/users/pieces', $cniVersoName);
        //on update les info dans la table informationIdentity
        $dataInfo = InformationIdenty::where('user_id',$id)->first();
        $data = InformationIdenty::findOrFail($dataInfo->id);
        //on verifie le numero principal et secondaire
        $checkPhoneOne = InformationIdenty::where('user_id','!=',Auth::user()->id)
            ->where('phone1',$request->phone)->first();
        if($checkPhoneOne!=null)
        {
            return back()->withInput()->with('error','Le numero principal est deja attribué à un utilisateur');
        }

        else
        {
            $data->name = $name;
            $data->nom = $nom;
            $data->prenoms = $prenom;
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
            $dataUser->name = $name;
            $dataUser->nom = $nom;
            $dataUser->prenoms = $prenom;
            $dataUser->phone = $request->phone;
            $dataUser->is_completed = 1;
            $dataUser->save();

            return redirect()->route('profil.index')->with('success','Profil mis à jour avec succès');

        }
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
                'phone'=>'unique:users'
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
            $nom = $request->nom;
            $prenom = $request->prenom;
            $name = $nom. ' '. $prenom;
            $photo=$request->photo;
            $photoName=time().'.'. $photo->extension();
            $photo = $photo->move('assets/img/users/photo', $photoName);
            $data = User::create(
                [
                    'nom'=>$nom,
                    'prenoms'=>$prenom,
                    'name'=>$name,
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
                    'nom'=>$data->nom,
                    'prenoms'=>$data->prenoms,
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

    public function showFormChangePassword()
    {
        $auth_id = Auth::user()->id;
        return view('front.inscription.changepassword', compact('auth_id'));
    }

    public function changePassword(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $validatorPassword = Validator::make($request->all(),
            [
                'password'=>'confirmed'
            ]);
        if($validatorPassword->fails())
        {
            return back()->withInput()->with('error','Les 2 mots de passe ne correspondent pas');
        }
        else
        {
            $data->password = Hash::make($request->password);
            $data->save();
            return redirect()->route('profil.index')->with('success','Mot de passe modifié avec succès');
        }
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

        /// ajouter le contact à la liste des contatcts CINETPAY

        return redirect()->back()->with('success','Inscription validée avec succès');
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
