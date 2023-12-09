<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $guarded = [];

    protected $with = ['commune','image','user'];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function passvisites()
    {
        return $this->belongsToMany(PassVisite::class,'visite_effectues');
    }

    /*public function visiteEffectue()
    {
        return $this->belongsToMany(VisiteEffectue::class, 'pass_visite_id')->withTimestamps();
    }*/


}
