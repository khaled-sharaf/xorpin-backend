<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRate extends Model
{

    protected $table = 'companies_rates';

    protected $fillable = ['rate', 'company_id', 'user_id'];
}
