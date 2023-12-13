<?php


namespace Database\Seeders;

use App\EbankProfil;
use App\InformationIdenty;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
            $n = $faker->lastname();
            $p = $faker->firstName($gender = 'male'|'female');
            $d = $faker->boolean();
            DB::table('users')->insert([
            'nom' =>  $n,
            'prenoms' => $p,
            'name' => $n.' '.$p ,
            'email' => $faker->email(),
            'phone' => '+22507'.$faker->randomNumber(8, true),
            'password' => Hash::make('password'),
            'is_demarcheur' => $d,
            'is_validated'=>false,
            'balance'=>0,
            ]);
            $data = User::where('nom',$n)->first();

                //on cree son profil
                InformationIdenty::create(
                    [
                        'name'=>$n.' '.$p,
                        'phone1'=>$data->phone,
                        'created_at'=>now(),
                        'user_id'=>$data->id,
                        'is_validated'=>0
                    ]);
            $dataIdentity = InformationIdenty::where('name',$data->name)->first();
                //on crée en meme temps son compte e-banking
            EbankProfil::create(
                    [
                        'balance'=>0,
                        'created_at'=>now(),
                        'information_identity_id'=>$dataIdentity->id,
                    ]);


        }
    }

}
