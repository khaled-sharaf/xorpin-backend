<?php

namespace App\Http\Controllers\API;

use App\ProductType as Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{

    public function all_categories() {
        $categories = Type::display()->get();

        return response($categories);
    }

}
