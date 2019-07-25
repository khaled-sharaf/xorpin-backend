<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductType extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'display', 'user_id'
    ];

    public function products()
    {
        return $this->hasMany('App\Product', 'type_id');
    }

    public function scopeDisplay($query)
    {
        return $query->where('display', 1);
    }
}
