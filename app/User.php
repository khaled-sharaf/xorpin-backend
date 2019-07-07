<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'phone', 'photo', 'active', 'rule', 'lang',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function productsWinner() {
        return $this->hasMany('App\Winner', 'user_id');
    }

    public function products() {
        return $this->hasMany('App\Product', 'user_id');
    }

    public function companies() {
        return $this->hasMany('App\Company', 'user_id');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
