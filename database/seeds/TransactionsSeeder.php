<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('transactions')->insert([
            'id' => 1,
            'transaction_number' => 'Tela_Internal_Expences',
            'operation_id' => 'Tela_First_Demarcheurs_Expences',
            'amount' => '0',
            'transaction_type' => 'Promotions',
            'transaction_way' => 'OM',
            'date_transaction'=>now(),
            'created_at'=>now()
        ]);

    }

}
