<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $l = [
            'Abobo',
            'Adjamé',
            'Anyama',
            'Attécoubé',
            'Bingerville',
            'Cocody',
            'Koumassi',
            'Marcory',
            'Plateau',
            'Port bouët',
            'Treichville',
            'Songon',
            'Yopougon',
          ];
          foreach ($l as $com) {
            DB::table('communes')->insert(['name' => $com,'created_at'=>now()]);
          }
    }

}
