<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassVisite extends Model
{
    protected $guarded = [];

    protected $with = ['passType','transaction'];

    public function passType()
    {
        return $this->belongsTo(PassType::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function places()
    {
        return $this->belongsToMany('App\Models\Place', 'visite_effectues');
    }

    public function visiteEffectue()
    {
        return $this->belongsToMany(VisiteEffectue::class, 'place_id')->withTimestamps();
    }

}
