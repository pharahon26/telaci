<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieProgrammeTvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorie_programme_tvs')->insert([
            'name' => 'Publicité',
            'picture' => 'pub.png',
            'created_at'=>now()
        ]);
        DB::table('categorie_programme_tvs')->insert([
            'name' => 'Emission live',
            'picture' => 'live.png',
            'created_at'=>now()
        ]);
        DB::table('categorie_programme_tvs')->insert([
            'name' => 'Emission différée',
            'picture' => 'differee.png',
            'created_at'=>now()
        ]);
        DB::table('categorie_programme_tvs')->insert([
            'name' => 'Rediffusion',
            'picture' => 'rediffusion.png',
            'created_at'=>now()
        ]);
        DB::table('categorie_programme_tvs')->insert([
            'name' => 'Sport',
            'picture' => 'sport.png',
            'created_at'=>now()
        ]);
        DB::table('categorie_programme_tvs')->insert([
            'name' => 'Music & films',
            'picture' => 'film.png',
            'created_at'=>now()
        ]);
    }

}
