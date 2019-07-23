<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'text_comment', 'positive_product', 'negative_product', 'display', 'user_id', 'product_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }


    public function scopeDisplay($query) {
        return $query->where('display', 1);
    }
}
