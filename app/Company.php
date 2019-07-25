<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Scopes\CountUserOfCompany;

class Company extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'logo', 'description', 'email', 'phone', 'website', 'address', 'longitude', 'latitude', 'face_link', 'tw_link', 'display', 'active', 'count_rates', 'user_id'
    ];


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


    public function scopeDisplay($query)
    {
        return $query->where('display', 1);
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CountUserOfCompany);
    }
}
