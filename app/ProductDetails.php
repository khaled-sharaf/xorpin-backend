<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_details';

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_details_rel', 'details_id', 'product_id');
    }

    public function productType()
    {
        return $this->belongsTo('App\ProductType', 'product_type_id');
    }
}
