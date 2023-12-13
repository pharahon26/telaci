<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CommuneSeeder::class);
        $this->call(TypeAbonnementSeeder::class);
        $this->call(PassTypeSeeder::class);
        $this->call(CategorieProgrammeTvSeeder::class);
        $this->call(EmissionTvSeeder::class);
        $this->call(TransactionsSeeder::class);
    }
}
