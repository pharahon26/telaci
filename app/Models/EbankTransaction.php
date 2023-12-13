<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbankTransaction extends Model
{
    protected $guarded = [];


    public function profil()
    {
        return $this->belongsTo(EbankProfil::class, 'ebank_profil_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
