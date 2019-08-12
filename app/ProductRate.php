<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    protected $table = 'products_rates';

    protected $fillable = ['rate', 'product_id', 'user_id'];
}
