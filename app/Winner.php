<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\RelationWinners;


class Winner extends Model
{
    protected $fillable = [
        // 'name', 'email', 'password', 'phone', 'address', 'photo', 'active', 'rule', 'lang', 'company_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }



    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RelationWinners);
    }
}
