<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpargneTransaction extends Model
{
    protected $guarded = [];


    public function epargne()
    {
        return $this->belongsTo(EbankProfil::class, 'epargne_account_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
