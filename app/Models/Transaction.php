<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $guarded = [];

    public function abonemment()
    {
        return $this->hasOne(Abonnement::class);
    }
    public function ebank_profile()
    {
        return $this->belongsToMany('App\Models\EbankProfil', 'ebank_transactions');
    }
}
