<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\CategorieProgrammeTv;
use App\InformationIdenty;
use App\PassTv;
use App\PassType;
use App\PassVisite;
use App\Place;
use App\ProgrammeTv;
use App\Transaction;
use App\TypeAbonnement;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nbinscriptions = InformationIdenty::count('id');
        $nbmaisons = Place::count('id');
        $nbprogrammes = ProgrammeTv::count('id');
        $nbtypeabonnements = TypeAbonnement::count('id');
        $nbabonnements = Abonnement::count('id');
        $nbpassvisites = PassVisite::count('id');
        $nbpasstvs = PassTv::count('id');
        $nbtransactions = Transaction::count('id');
        $nbtypepass = PassType::count('id');
        $nbcategorieemissions = CategorieProgrammeTv::count('id');
        $nbusers = User::where('is_staff',1)->count('id');
        return view('dashboard',
            compact('nbinscriptions','nbmaisons'
            ,'nbprogrammes','nbtypeabonnements','nbabonnements',
                'nbpassvisites','nbpasstvs','nbtransactions',
                'nbtypepass','nbusers','nbcategorieemissions'));
    }
}
