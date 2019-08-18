<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Image;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ResetPassword;
use App\Mail\VerifyEmail;


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
            return response(['status' => true]);
        }
        return response(['status' => false]);
    }



    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,180',
            'email' => 'required|email|max:180|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'address' => 'required|integer|between:1,27',
            'phone' => 'nullable|unique:users|regex:' . $this->patternPhone
        ]);
        $data = $request->except(['password_confirmation']);
        $data['password'] = bcrypt($request->password);

        $data['photo'] = $this->defaultAvatar;

        User::create($data);

        // send mail verify email
        $email = $request->email;
        $token = str_random(64);
        $url = $request->url . '?token=' . $token;
        $email = $request->email;

        // send token to mail
        $mailSend = \Mail::to($email)->send(new VerifyEmail(['url' => url('/verify-email' . $url)]));

        // save token in database
        DB::table('password_resets')->where('email', $email)->delete();

        $saved = DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        return response(['status' => true, 'message' => 'تم إنشاء عضوية جديدة، برجاء تفعيل البريد الإلكترونى.']);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        $request->validate([
            'name' => 'required|string|between:2,180',
            'email' => 'required|email|max:180|unique:users,email,'. $id,
            'password' => 'required|confirmed|string|min:8',
            'address' => 'required|integer|between:1,27',
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
        return response(['status' => true, 'message' => 'تم تعديل بيانات المستخدم بنجاح.']);
    }



    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $status = false;
        $message = '';
        // check mail
        $check_mail = User::where('email', $email)->first();
        if ($check_mail === null) {
            $message = 'البريد الإلكترونى غير صحيح.';
        } else {
            $token = str_random(64);
            $url = $request->url . '?token=' . $token;
            $email = $request->email;

            // send token to mail
            // $mailSend = \Mail::to($email)->send(new ResetPassword(['url' => url('/reset-password' . $url)]));
            $mailSend = \Mail::to($email)->send(new ResetPassword(['url' => 'http://localhost:3000/reset-password' . $url]));

            // save token in database
            DB::table('password_resets')->where('email', $email)->delete();

            $saved = DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            if ($saved) {
                $status = true;
                $message = 'تم إرسال رسالة استرجاع كلمة السر إلى بريدك الإلكترونى.';
            } else {
                $message = 'لم يتم إرسال الرسالة.';
            }

        }
        return response(['status' => $status, 'message' => $message]);
    }

    public function resetPassword(Request $request)
    {
        $token = $request->token;
        $status = false;
        $message = '';
        $check_token = DB::table('password_resets')->where('token', $token)->first();
        if ($check_token === null) {
            $message = 'رمز التفعيل غير صحيح.';
        } else {
            if ($check_token->created_at > Carbon::now()->subHours(2)) {
                $request->validate([
                    'password' => 'required|confirmed|string|min:8',
                ]);
                User::where('email', $check_token->email)->update([
                    'password' => bcrypt($request->password)
                ]);
                DB::table('password_resets')->where('token', $token)->delete();

                $status = true;
                $message = 'تم تغيير كلمة السر بنجاح.';
            } else {
                $message = 'انتهى وقت صلاحية رمز التفعيل الخاص باسترجاع كلمة السر، من فضلك أرسل رسالة أخرى لاسترجاع كلمة السر.';
            }
        }
        return response(['status' => $status, 'message' => $message]);
    }


    public function verifyEmail(Request $request)
    {
        $email = $request->email;
        $status = false;
        $message = '';
        // check mail
        $check_mail = User::where('email', $email)->first();
        if ($check_mail === null) {
            $message = 'البريد الإلكترونى غير صحيح.';
        } else {
            $token = str_random(64);
            $url = $request->url . '?token=' . $token;
            $email = $request->email;

            // send token to mail
            $mailSend = \Mail::to($email)->send(new VerifyEmail(['url' => url('/verify-email' . $url)]));

            // save token in database
            DB::table('password_resets')->where('email', $email)->delete();

            $saved = DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            if ($saved) {
                $status = true;
                $message = 'تم إرسال رسالة التحقق من بريدك الإلكترونى.';
            } else {
                $message = 'لم يتم إرسال الرسالة.';
            }

        }
        return response(['status' => $status, 'message' => $message]);
    }


    public function activeEmail(Request $request)
    {
        $token = $request->token;
        $status = false;
        $message = '';
        $check_token = DB::table('password_resets')->where('token', $token)->first();
        if ($check_token === null) {
            $message = 'رمز التفعيل غير صحيح.';
        } else {
            if ($check_token->created_at > Carbon::now()->subHours(2)) {
                User::where('email', $check_token->email)->update([
                    'email_verified_at' => Carbon::now()
                ]);
                DB::table('password_resets')->where('token', $token)->delete();

                $status = true;
                $message = 'تم تفعيل بريدك الإلكترونى بنجاح.';
            } else {
                $message = 'انتهى وقت صلاحية رمز التفعيل الخاص بالتحقق من البريد الإلكترونى، من فضلك أرسل رسالة أخرى للتحقق من البريد الإلكترونى.';
            }
        }
        if ($status) {
            return redirect('/');
        }
        //  else {
        //     return response(['message' => $message]);
        // }
    }

}
