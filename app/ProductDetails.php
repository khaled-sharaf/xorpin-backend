<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_details';

    protected $fillable = [
        'name', 'value', 'display', 'user_id', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function scopeDisplay($query)
    {
        return $query->where('display', 1);
    }
}
