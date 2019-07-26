<?php

namespace App\Http\Controllers\API;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SettingController extends Controller
{

    public function carousel(Request $request) {
        $carousel_db_string = Setting::where('name', 'carousel')->first();
        if ($carousel_db_string != null) {
            $carousel = explode(',', $carousel_db_string->value);
            $carousel_result = [];
            $i = 1;
            foreach ($carousel as $image) {
                $carousel_result[] = ['id' => $i, 'image' => $image];
                $i++;
            }
            return response($carousel_result);
        } else {
            return null;
        }
    }
}
