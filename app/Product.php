<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\RelationProducts;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'name', 'photo', 'gallery', 'price', 'discount', 'percent', 'new_price', 'description', 'manufacture_company', 'product_count', 'execute', 'display', 'type_id', 'user_id', 'company_id'
    ];

    public function details() {
        return $this->hasMany('App\ProductDetails', 'product_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'product_id');
    }

    public function winners()
    {
        return $this->hasMany('App\Winner', 'product_id');
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


    public function scopeActiveAndDisplay($query)
    {
        return $query->where('display', 1)
            ->whereHas('company', function ($q) {
                $q->where('display', 1);
            })
            ->whereHas('type', function ($q) {
                $q->where('display', 1);
            });
    }

    public function scopeDisplay($query)
    {
        return $query->where('display', 1);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RelationProducts);
    }
}
