<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class UserController extends Controller
{

    public function get_user_auth(Request $request) {
        return $request->user();
    }


    public function logout(Request $request) {
        $token = $request->user()->token();
        $token_id = $token->id;
        if ($token->delete()) {
            DB::table('oauth_refresh_tokens')->where('access_token_id', $token_id)->delete();
            return response(['logout' => true]);
        }
    }
}
