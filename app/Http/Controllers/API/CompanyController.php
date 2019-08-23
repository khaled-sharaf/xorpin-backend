<?php

namespace App\Http\Controllers\API;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function partners() {
        $default_image = 'images/companies-logo/company-default-avatar.jpg';

        $logos = Company::select('logo', 'id')->where('logo', '!=', $default_image)->display()->get();

        $partners_images = [];

        foreach ($logos as $logo) {
            $partners_images[] = ['id' => $logo->id, 'image' => $logo->logo];
        }

        return response($partners_images);
    }


    public function all_companies() {
        $companies = Company::display()->get();

        return response($companies);
    }



    public function company_profile($id) {
        if ($id !== null)
        {
            $company = Company::display()->find($id);
            return response($company);
        }
    }


    public function add_rate(Request $request) {
        $rate = $request->rate;
        $company_id = $request->company_id;
        $user_id = $request->user()->id;
        $status = true;
        try {
            $product = Company::find($company_id);
            $rate_user_exists = $product->rates()->where('user_id', $user_id)->first();

            if ($rate_user_exists !== null) {
                // update old rate
                $rate_user_exists->rate = $rate;
                $rate_user_exists->save();
            } else {
                // add new rate
                $product->rates()->create([
                    'rate' => $rate,
                    'company_id' => $company_id,
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



    public function set_visit($id)
    {
        $company = Company::find($id);
        $status = false;
        $message = 'company is null.';
        if ($company !== null) {
            $company->visits = $company->visits + 1;
            $company->save();
            $status = true;
            $message = 'updated visits of company.';
        }
        return response(['status' => $status, 'message' => $message]);
    }



    public function get_visits($id)
    {
        $company = Company::find($id);
        $visits = null;
        if ($company !== null) {
            $visits = $company->visits;
        }
        return response(['visits' => $visits]);
    }


}
