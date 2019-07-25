<?php

namespace App\Http\Controllers\API;

use App\Winner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WinnerController extends Controller
{

    public function all_winners() {

        $winners = Winner::take(10)->orderBy('id', 'desc')->get();

        return response($winners);
    }
}
