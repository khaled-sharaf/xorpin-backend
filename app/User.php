<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'photo', 'active', 'rule', 'lang', 'company_id'
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

    public function winners() {
        return $this->hasMany('App\Winner', 'user_id');
    }

    public function companies() { // companies added by user
        return $this->hasMany('App\Company', 'user_id');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
