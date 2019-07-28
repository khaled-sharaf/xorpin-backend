<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\GetGovernorate;

class City extends Model
{
    protected $table = 'cities';

    public function governorate() {
        return $this->belongsTo('App\Governorate', 'gov_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GetGovernorate);
    }
}
