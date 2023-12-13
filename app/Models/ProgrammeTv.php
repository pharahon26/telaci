<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgrammeTv extends Model
{
    protected $guarded = [];

    protected $with = ['categorie'];

    public function categorie()
    {
        return $this->belongsTo(CategorieProgrammeTv::class);
    }

    // public function listeDiffusion()
    // {
    //     return $this->hasMany(ListeDiffusion::class);
    // }
}
