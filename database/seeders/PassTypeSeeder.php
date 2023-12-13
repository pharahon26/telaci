<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pass_types')->insert([
            'name' => 'Pass 5 maisons',
            'is_visite' => 1,
            'nb_visite' => 5,
            'price' => '2000',
            'created_at'=>now()
        ]);
        DB::table('pass_types')->insert([
            'name' => 'Pass 10 maisons',
            'is_visite' => 1,
            'nb_visite' => 10,
            'price' => '3000',
            'created_at'=>now()
        ]);
        DB::table('pass_types')->insert([
            'name' => 'Pass 20 maisons',
            'is_visite' => 1,
            'nb_visite' => 20,
            'price' => '5000',
            'created_at'=>now()
        ]);
        DB::table('pass_types')->insert([
            'name' => 'Pass Tv',
            'is_visite' => 0,
            'nb_visite' => 0,
            'price' => '300',
            'created_at'=>now()
        ]);

    }
}
