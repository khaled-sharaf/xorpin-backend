<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\Governorate;

class HomeController extends Controller
{

    public function index()
    {
        // return view('admin.cp_layout');
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

}
