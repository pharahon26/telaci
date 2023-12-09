<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisiteEffectue extends Model
{
    protected $guarded = [];


    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function passVisite()
    {
        return $this->belongsTo(PassVisite::class, 'pass_visite_id');
    }

}
