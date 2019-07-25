<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CountUserOfCompany implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->withCount(['users', 'products', 'rates as rate_user_count']);
    }
}
