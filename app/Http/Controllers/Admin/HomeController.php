<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Company;
use App\Product;
use App\ProductType as Type;
use App\Winner;
use App\Comment;
use App\City;
use App\Governorate;

class HomeController extends Controller
{

    public function index()
    {
        return view('admin.cp_layout');
    }

    public function getCounts() {
        $counts = [
            'users' => auth()->user()->rule == 2 ? User::where('company_id', auth()->user()->company_id)->count() : User::count(),

            'companies' => Company::count(),

            'categories' => Type::count(),

            'products' => auth()->user()->rule == 2 ? Product::where('company_id', auth()->user()->company_id)->count() : Product::count(),

            'winners' => auth()->user()->rule == 2 ? Winner::whereHas('product', function ($q) {
                $q->where('company_id', auth()->user()->company_id);
            })->count() : Winner::count(),

            'comments' => auth()->user()->rule == 2 ? Comment::whereHas('product', function ($q) {
                $q->where('company_id', auth()->user()->company_id);
            })->count() : Comment::count()

        ];
        return response(['counts' => $counts]);
    }


    public function cities()
    {
        $all_governorates = Governorate::orderby('governorate_name', 'asc')->get();
        $cities = [];
        foreach ($all_governorates as $gov) {
            $cities[] = [
                            'governorate' => $gov,
                            'cities' => City::where('gov_id', $gov->id)->orderby('city_name', 'asc')->get()
                        ];
        }
        return $cities;
    }


    public function governorates()
    {
        $all_governorates = Governorate::get();
        return $all_governorates;
    }

}
