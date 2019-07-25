<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Company;
use App\Product;
use App\Winner;
use App\Comment;

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

}
