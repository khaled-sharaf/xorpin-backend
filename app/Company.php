<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{


    public function users()
    {
        return $this->hasMany('App\User', 'company_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'company_id');
    }

    public function rates()
    {
        return $this->hasMany('App\CompanyRate', 'company_id');
    }
}
