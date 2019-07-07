<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

    ];

    public function details() {
        return $this->belongsToMany('App\ProductDetails', 'product_details_rel', 'product_id', 'details_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function type()
    {
        return $this->belongsTo('App\ProductType', 'type_id');
    }

    public function rates()
    {
        return $this->hasMany('App\ProductRate', 'product_id');
    }

}
