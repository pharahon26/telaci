<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassTv extends Model
{
    protected $guarded = [];

    protected $with = ['passType','programmeTv','transactionData'];

    public function passType()
    {
        return $this->belongsTo(PassType::class);
    }

    public function programmeTv()
    {
        return $this->belongsTo(ProgrammeTv::class);
    }

    public function transactionData()
    {
        return $this->belongsTo(Transaction::class);
    }

}
