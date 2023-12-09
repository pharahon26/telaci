<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('type_abonnements')->insert([
            'title' => 'Basic',
            'pourcentage_demarcheur' => 10,
            'type' => 'demarcheur',
            'price' => '5000',
            'created_at'=>now()
        ]);

        DB::table('type_abonnements')->insert([
            'title' => 'Medium',
            'pourcentage_demarcheur' => 18,
            'type' => 'demarcheur',
            'price' => '15000',
            'created_at'=>now()
        ]);

        DB::table('type_abonnements')->insert([
            'title' => 'Premium',
            'pourcentage_demarcheur' => 25,
            'type' => 'demarcheur',
            'price' => '30000',
            'created_at'=>now()
        ]);

    }
}
