<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->rule == 1 || auth()->user()->rule == 2) {
            if (auth()->user()->active == 0) {
                return view('home', ['title' => 'حسابك ليس  مفعل', 'message' => 'حسابك ليس مفعل، برجاء الرجوع إلى مدير الموقع ثم التسجيل مرة أخرى.']);
            } else if (auth()->user()->rule == 2 && auth()->user()->company->active == 0) {
                return view('home', ['title' => 'حساب شركتك ليس  مفعل', 'message' => 'حساب شركتك ليس مفعل، برجاء الرجوع إلى مدير الموقع ثم التسجيل مرة أخرى.']);
            } else {
                return redirect(env('CP_PREFIX') . '/dashboard');
            }
        } else {
            return abort(404);
        }
    }
}
