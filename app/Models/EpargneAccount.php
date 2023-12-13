<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpargneAccount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'epargne_accounts';
    protected $guarded = [];

    protected $with = ['ebank',];

    public function ebank()
    {
        return $this->belongsTo(EbankProfil::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'epargne_transactions');
    }

    // public function epargneTransactions()
    // {
    //     return $this->belongsToMany(EpargneTransaction::class, 'transaction_id');
    // }
}
