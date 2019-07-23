<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductType as Category;

class ProductController extends Controller
{

    public function homePage(Request $request) {
        $products_result = [];
        $categories = Category::get();
        foreach ($categories as $category) {
            $products_result[$category->name] = Product::activeAndDisplay()->where('type_id', $category->id)->orderBy('id', 'desc')->get();
        }
        return response(['products' => $products_result], 200);
    }

    public function product_profile(Request $request, $id) {
        if ($id !== null)
        {
            $product = Product::with('comments')->activeAndDisplay()->find($id);
            return response($product, 200);
        }

    }
}
