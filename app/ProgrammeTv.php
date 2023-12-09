<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgrammeTv extends Model
{
    protected $guarded = [];

    protected $with = ['categ'];

    public function categ()
    {
        return $this->belongsTo(CategorieProgrammeTv::class);
    }
}
