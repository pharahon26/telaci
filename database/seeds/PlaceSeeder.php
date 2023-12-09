<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=1; $i < 11; $i++) {
            DB::table('places')->insert([
            'latitude' => '0.0',
            'longitude' => '0.0',
            'price' => $faker->numberBetween(200000, 10000000),
            'proprio_name' => $faker->name() ,
            'proprio_telephone' => '+22507'.$faker->randomNumber(8, true),
            'user_id' => 1,
            'image_id' => $i,
            'commune_id' => $faker->numberBetween(1, 13),
            'nombre_piece' => $faker->numberBetween(2, 20),
            'nombre_salle_eau' => $faker->numberBetween(0, 15),
            'is_validated' => $faker->boolean(),
            'is_Bureau' => $faker->boolean(),
            'is_Studio' => $faker->boolean(),
            'is_Chambre' => $faker->boolean(),
            'is_rejected' => $faker->boolean(),
            'is_Appartment' => $faker->boolean(),
            'is_MAISON_BASSE' => $faker->boolean(),
            'has_COUR_AVANT' => $faker->boolean(),
            'has_COUR_ARRIERE' => $faker->boolean(),
            'has_GARDIEN' => $faker->boolean(),
            'has_GARAGE' => $faker->boolean(),
            'description' => $faker->text(),
                'ref'=>uniqid()
            ]);

            //on cree les images
            $tableau = array();
            for ($j=1; $j < 11; $j++) {
                array_push($tableau, $j.'.'.'jpg,');
            }

            $string = implode("",$tableau);
            DB::table('images')->insert([
                'place_id' => $i,
                'url' => $string,
                'created_at'=>now()
            ]);

        }
    }

}
