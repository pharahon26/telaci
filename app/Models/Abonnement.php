<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $guarded = [];

    protected $with = ['user','typeAbonnement','transaction'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeAbonnement()
    {
        return $this->belongsTo(TypeAbonnement::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
