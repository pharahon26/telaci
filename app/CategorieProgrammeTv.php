<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieProgrammeTv extends Model
{
    protected $guarded = [];
    protected $table = 'categorie_programme_tvs';
    public function listeDiffusion()
    {
        return $this->hasMany(ListeDiffusion::class);
    }
}
