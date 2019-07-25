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
            $partners_images[$logo->id] = $logo->logo;
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
}
