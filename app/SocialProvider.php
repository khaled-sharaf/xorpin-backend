<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{

    protected $fillable = ['user_id', 'provider', 'provider_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
