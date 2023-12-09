<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EbankProfil extends Model
{
    protected $guarded = [];

    protected $with = ['informationIdentity'];

    public function informationIdentity()
    {
        return $this->belongsTo(InformationIdenty::class);
    }
}
