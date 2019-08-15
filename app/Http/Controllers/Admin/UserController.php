<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $patternPhone = "/^\+?\d{10,14}$/";
    private $patternPassword = "/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{6,16}$/";
    private $defaultAvatar = "images/user-avatar/default-avatar.png";


    public function users_id()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response($users);
    }

    public function index(Request $request)
    {
        $columns = ['index', 'id', 'name', 'email', 'phone', 'address', 'photo', 'rule', 'active', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $active = $request->active;
        $rule = $request->rule;
        $trashed = $request->trashed;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = User::select('*')->orderBy($columns[$column], $dir);

        // handel users trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }

        if ($request->companyId != null) {
            $query->where('company_id', $request->companyId);
        }

        if ($active != '') {
            $query->where('active', $active);
        }
        if ($rule != '') {
            $query->where('rule', $rule);
        }
        if ($from_date != '') {
            $query->whereDate('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $query->whereDate('created_at', '<=', $to_date);
        }
        if ($searchValue) {
            if (strpos($searchValue,  ':') != false) {
                $columnSearch = explode(':', $searchValue)[0];
                $valueColumn = explode(':', $searchValue)[1];
                if ($columnSearch != 'id') {
                    $query->where($columnSearch, 'like', '%' . $valueColumn . '%');
                } else {
                    $query->where($columnSearch, $valueColumn);
                }
            } else {
                $query->where(function($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', $searchValue)
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('address', 'like', '%' . $searchValue . '%');
                });
            }
        }
        if ($request->has('winners')) {
            if ($request->has('winners_product_id')) {
                $query->whereHas('winners', function ($q) use ($request) {
                    $q->where('product_id', $request->winners_product_id);
                });
            } else {
                $query->has('winners');
            }
        }
        $users = $query->paginate($length);
        return response(['data' => $users, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }



    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|between:2,180',
            'password' => 'required|string|between:4,16|confirmed',
            'email' => 'required|email|max:180|unique:users',
            'phone' => 'nullable|unique:users|regex:' . $this->patternPhone,
            'address' => 'required|integer|between:1,27',
            'rule' => 'required|in:0,1,2',
            'active' => 'required|in:0,1',
            'photo' => 'nullable|string'
        ]);

        $userData = $request->except(['password_confirmation']);
        $userData['password'] = bcrypt($request->password);

        if ($request->rule == 2) {
            $this->validate(request(), [
                'company_id' => 'required|exists:companies,id'
            ]);
        } else {
            $userData['company_id'] = null;
        }

        if (strpos($userData['photo'], 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $userData['photo'])[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = time() . '-' . Str::kebab(strtolower($userData['name'])) . '-avatar.' . $ext;
            $imagePath = 'images/user-avatar/' . $imageNewName;
            Image::make($userData['photo'])
            ->resize(150, 150)
            ->save(public_path($imagePath));
            $userData['photo'] = $imagePath;
        }
        User::create($userData);
        return response(['message' => 'User has been created.']);
    }


    public function edit(Request $request)
    {
        if (auth()->user()->rule == 2) {
            $user = User::where('id', $request->id)->where('company_id', auth()->user()->company_id)->first();
        } else {
            $user = User::find($request->id);
        }
        return response(['user' => $user]);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $this->validate(request(), [
            'name' => 'required|string|between:2,180',
            'password' => 'nullable|string|between:4,16|confirmed',
            'email' => 'required|email|max:180|unique:users,email,'. $id,
            'phone' => 'nullable|regex:' . $this->patternPhone . '|unique:users,phone,'. $id,
            'address' => 'required|integer|between:1,27',
            'rule' => 'in:0,1,2',
            'active' => 'in:0,1',
            'photo' => 'nullable|string'
        ]);
        $userData = $request->except(['password_confirmation']);
        if (array_has($userData, 'password') && $userData['password'] != '') {
            $userData['password'] = bcrypt($userData['password']);
        } else {
            $userData['password'] = $user->password;
        }

        if ($request->rule == 2) {
            $this->validate(request(), [
                'company_id' => 'required|exists:companies,id'
            ]);
        } else {
            $userData['company_id'] = null;
        }


        if (strpos($userData['photo'], 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $userData['photo'])[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = time() . '-' . Str::kebab(strtolower($userData['name'])) . '-avatar.' . $ext;
            $imagePath = 'images/user-avatar/' . $imageNewName;

            // delete old image if exists
            if ($user->photo != $this->defaultAvatar && $user->photo !== null) {
                if (file_exists(public_path($user->photo))) {
                    unlink(public_path($user->photo));
                }
            }

            // add new image to directory
            Image::make($userData['photo'])
            ->resize(150, 150)
            ->save(public_path($imagePath));
            $userData['photo'] = $imagePath;


        } else if ($userData['photo'] == $this->defaultAvatar && ($user->photo != $this->defaultAvatar && $user->photo != null)) {
            if (file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
        }

        $user->update($userData);
        return response(['message' => 'The user has been updated.']);
    }





    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id != 1) {
            $user = User::withTrashed()->where('id', $id)->first();
            if ($user->trashed()) {
                // delete image if exists
                if ($user->photo != $this->defaultAvatar && $user->photo !== null) {
                    if (file_exists(public_path($user->photo))) {
                        unlink(public_path($user->photo));
                    }
                }
                $user->forceDelete();
            } else {
                $user->delete();
            }
            return response(['status' => true]);
        } else {
            return response(['error' => 'This user can\'t delete it.'], 403);
        }
    }


    public function restoreUser(Request $request)
    {
        $id = $request->id;
        $user_deleted = User::onlyTrashed()->where('id', $id)->first();
        $user_deleted->restore();
        return response(['status' => true]);
    }

}
