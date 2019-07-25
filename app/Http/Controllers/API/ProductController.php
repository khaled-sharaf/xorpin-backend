<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductType as Category;
use App\Scopes\RelationProducts;

class ProductController extends Controller
{

    public function homePage() {
        $products_result = [];
        $categories = Category::get();
        foreach ($categories as $category) {
            $products_result[$category->name] = Product::withoutGlobalScope(RelationProducts::class)
                                ->activeAndDisplay()
                                ->withCount('rates as rate_user_count')
                                ->where('type_id', $category->id)
                                ->orderBy('id', 'desc')
                                ->take(8)->get();
        }
        return response($products_result);
    }

    public function products_category(Request $request) {
        $length = $request->length == null || $request->length < 0 ? 12 : $request->length;
        $category = $request->category;
        $searchColumn = is_numeric($category) ? 'id' : 'name';

        $products = Product::withoutGlobalScope(RelationProducts::class)
                            ->activeAndDisplay()
                            ->withCount('rates as rate_user_count')
                            ->whereHas('type', function ($query) use ($searchColumn, $category) {
                                $query->where($searchColumn, $category);
                            })
                            ->orderBy('id', 'desc')
                            ->paginate($length);

        return response($products);
    }



    public function products_company(Request $request) {
        $length = $request->length == null || $request->length < 0 ? 12 : $request->length;
        $company_id = $request->id;

        $products = Product::withoutGlobalScope(RelationProducts::class)
                            ->withCount('rates as rate_user_count')
                            ->activeAndDisplay()
                            ->where('company_id', $company_id)
                            ->orderBy('id', 'desc')
                            ->paginate($length);

        return response($products);
    }





    public function product_profile($id) {
        if ($id !== null)
        {
            $product = Product::with(['comments', 'rates'])->activeAndDisplay()->find($id);
            $data = $product->toArray();
            $data['rates'] = every_rate($product->rates); // helper function
            return response($data);
        }
    }
}
// $test = $rate_1->count()
//     + ($rate_2->count() * 2)
//     + ($rate_3->count() * 3)
//     + ($rate_4->count() * 4)
//     + ($rate_5->count() * 5);
