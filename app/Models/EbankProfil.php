<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbankProfil extends Model
{
    protected $guarded = [];

    protected $with = ['informationIdentity'];

    public function informationIdentity()
    {
        return $this->belongsTo(InformationIdenty::class);
    }
    public function epargne()
    {
        return $this->hasOne(EpargneAccount::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'ebank_transactions');
    }
}
