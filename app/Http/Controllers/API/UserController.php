<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Image;
use Illuminate\Support\Str;

class UserController extends Controller
{

    private $patternPhone = "/^\+?\d{10,14}$/";
    private $defaultAvatar = "images/user-avatar/default-avatar.png";



    public function get_user_auth(Request $request) {
        return $request->user();
    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token_id = $token->id;
        if ($token->delete()) {
            $refresh_token = DB::table('oauth_refresh_tokens')->where('access_token_id', $token_id);
            if ($refresh_token->count() > 0) {
                $refresh_token->delete();
            }
            return response(['logout' => true]);
        }
        return response(['logout' => false]);
    }



    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,180',
            'email' => 'required|email|max:180|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'address' => 'required',
            'phone' => 'nullable|unique:users|regex:' . $this->patternPhone
        ]);
        $data = $request->except(['password_confirmation']);
        $data['password'] = bcrypt($request->password);

        $data['photo'] = $this->defaultAvatar;

        User::create($data);
        return response(['message' => 'User has been created.']);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        $request->validate([
            'name' => 'required|string|between:2,180',
            'email' => 'required|email|max:180|unique:users,email,'. $id,
            'password' => 'required|confirmed|string|min:8',
            'address' => 'required',
            'phone' => 'nullable|regex:' . $this->patternPhone . '|unique:users,phone,'. $id,
            'photo' => 'nullable|string'
        ]);

        $data = $request->except(['password_confirmation']);
        if (array_has($data, 'password') && $data['password'] != '') {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }


         if ($request->photo == null && ($user->photo != $this->defaultAvatar && $user->photo != null)) {
            if (file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
        } else {
            if (array_has($data, 'photo') && strpos($data['photo'], 'data:image/') === 0) {
                $get_ext = explode(';', explode('/', $data['photo'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName = time() . '-' . Str::kebab(strtolower($data['name'])) . '-avatar.' . $ext;
                $imagePath = 'images/user-avatar/' . $imageNewName;

                // delete old image if exists
                if ($user->photo != $this->defaultAvatar && $user->photo !== null) {
                    if (file_exists(public_path($user->photo))) {
                        unlink(public_path($user->photo));
                    }
                }
                // add new image to directory
                Image::make($data['photo'])
                ->resize(150, 150)
                ->save(public_path($imagePath));
                $data['photo'] = $imagePath;
            }
        }
        if ($request->photo == null) {
            $data['photo'] = $this->defaultAvatar;
        }

        $user->update($data);
        return response(['message' => 'The user has been updated.']);
    }


}
