<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $guarded = [];

    public function abonemment()
    {
        return $this->hasOne(Abonnement::class);
    }
}
