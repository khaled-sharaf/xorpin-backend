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
                                                        ->with('company')
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

    public function search(Request $request) {
        $category_id = $request->category_id;
        $search_text = $request->search_text;
        $products = Product::withoutGlobalScope(RelationProducts::class)
                            ->activeAndDisplay()
                            ->withCount('rates as rate_user_count')
                            ->with('company')
                            ->where('type_id', $category_id)
                            ->where(function ($q) use ($search_text) {
                                $search_text_array_words = explode(' ', trim($search_text));
                                foreach ($search_text_array_words as $word) {
                                    if (trim($word) != '') {
                                        $q->orWhere('name', 'like', '%' . $word . '%')
                                        ->orWhere('description', 'like', '%' . $word . '%')
                                        ->orWhere('manufacture_company', 'like', '%' . $word . '%');
                                    }
                                }
                            })
                            ->orderBy('name', 'asc')
                            ->get();
        if ($products->count() > 0) {
            $products = convert_gallery_to_array($products);
        }
        return response($products);
    }


    public function products_category(Request $request, $id) {
        // $length = $request->length == null || $request->length < 0 ? 12 : $request->length;
        $price = $request->price;
        $manufacture_company = $request->manufacture_company;

        $products = Product::withoutGlobalScope(RelationProducts::class)
                            ->activeAndDisplay()
                            ->withCount('rates as rate_user_count')
                            ->with('company')
                            ->where('type_id', $id)
                            ->where(function ($q) use($price, $manufacture_company) {
                                if ($price != null) {
                                    $q->where('price', '<=', $price);
                                }
                                if ($manufacture_company != null) {
                                    $q->where('manufacture_company', 'like', '%' . $manufacture_company . '%');
                                }
                            })
                            ->orderBy('id', 'desc')
                            ->get();
                            // ->paginate($length);
        if ($products->count() > 0) {
            $products = convert_gallery_to_array($products);
        }
        return response($products);
    }



    public function products_company(Request $request, $id) {
        // $length = $request->length == null || $request->length < 0 ? 12 : $request->length;
        $price = $request->price;
        $manufacture_company = $request->manufacture_company;

        $products = Product::withoutGlobalScope(RelationProducts::class)
                            ->withCount('rates as rate_user_count')
                            ->with('company')
                            ->activeAndDisplay()
                            ->where('company_id', $id)
                            ->where(function ($q) use($price, $manufacture_company) {
                                if ($price != null) {
                                    $q->where('price', '<=', $price);
                                }
                                if ($manufacture_company != null) {
                                    $q->where('manufacture_company', 'like', '%' . $manufacture_company . '%');
                                }
                            })
                            ->orderBy('id', 'desc')
                            ->get();
                            // ->paginate($length);
        if ($products->count() > 0) {
            $products = convert_gallery_to_array($products);
        }
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

    public function add_rate(Request $request) {
        $rate = $request->rate;
        $product_id = $request->product_id;
        $user_id = $request->user()->id;
        $status = true;
        try {
            $product = Product::find($product_id);
            $rate_user_exists = $product->rates()->where('user_id', $user_id)->first();

            if ($rate_user_exists !== null) {
                // update old rate
                $rate_user_exists->rate = $rate;
                $rate_user_exists->save();
            } else {
                // add new rate
                $product->rates()->create([
                    'rate' => $rate,
                    'product_id' => $product_id,
                    'user_id' => $user_id
                ]);
            }
            // add rating to product in column count rates
            $rating = $product->rates->sum('rate');
            $product->count_rates = $rating;
            $product->save();
        } catch (Exception $e) {
            $status = false;
        }
        return response(['status' => $status]);
    }
}
