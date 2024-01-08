<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SouscriptionPublicite extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['packPublicite'];

    public function packPublicite()
    {
        return $this->belongsTo(PackPublicite::class);
    }

}
