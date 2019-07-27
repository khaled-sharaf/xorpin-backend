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
        $products_and_category = [];
        $categories = Category::get();
        foreach ($categories as $category) {
            $products_and_category[] = [
                                    'category' => $category,
                                    'products' => Product::withoutGlobalScope(RelationProducts::class)
                                                        ->activeAndDisplay()
                                                        ->withCount('rates as rate_user_count')
                                                        ->where('type_id', $category->id)
                                                        ->orderBy('id', 'desc')
                                                        ->take(8)->get()
                                ];
        }
        foreach ($products_and_category as $item) {
            if ($item['products']->count() > 0) {
                $item['products'] = convert_gallery_to_array($item['products']);
                $products_result[] = $item;
            }
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
        $products = convert_gallery_to_array($products);
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
        $products = convert_gallery_to_array($products);
        return response($products);
    }



    public function product_profile($id) {
        if ($id !== null)
        {
            $product = Product::with(['comments', 'rates'])->activeAndDisplay()->find($id);
            if ($product != null) {
                $product = convert_gallery_to_array($product);
                $data = $product->toArray();
                $data['rates'] = every_rate($product->rates); // helper function
                return response($data);
            } else {
                return response(['product' => null]);
            }
        }
    }
}
// $test = $rate_1->count()
//     + ($rate_2->count() * 2)
//     + ($rate_3->count() * 3)
//     + ($rate_4->count() * 4)
//     + ($rate_5->count() * 5);
