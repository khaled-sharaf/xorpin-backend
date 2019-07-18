<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        $columns = ['id', 'slug', 'name', 'value', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $query = Setting::select('*')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('slug', 'like', '%' . $searchValue . '%');
            });
        }
        $settings = $query->paginate($length);
        return response(['data' => $settings, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir], 200);
    }



    public function store(Request $request)
    {
        $this->validate(request(), [
            'slug' => 'required|string|max:191',
            'name' => 'required|string|alpha_dash|max:191|unique:settings',
            'value' => 'required|string',
            'type' => 'required|in:image,string,text',
        ]);
        $request->merge(['user_id' => auth()->id()]);

        if (strpos($request->value, 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $request->value)[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = uniqid('setting-image-') . '-' . strtolower($request->name) . '.' . $ext;
            $imagePath = 'images/settings/' . $imageNewName;
            Image::make($request->value)->save(public_path($imagePath));
            $request->merge(['value' => $imagePath]);
        }
        Setting::create($request->all());
        return response(['message' => 'Setting has been created.'], 200);
    }


    public function edit(Request $request)
    {
        $setting = Setting::find($request->id);
        return response(['setting' => $setting], 200);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $setting = Setting::find($id);
        $this->validate(request(), [
            'slug' => 'required|string|max:191',
            'name' => 'required|string|alpha_dash|max:191|unique:settings,name,'. $id,
            'value' => 'required|string',
            'type' => 'required|in:image,string,text'
        ]);

        // delete old image if exists
        if ($setting->type == 'image' && $request->value != $setting->value) {
            if (file_exists(public_path($setting->value))) {
                unlink(public_path($setting->value));
            }
        }

        if (strpos($request->value, 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $request->value)[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = uniqid('setting-image-') . '-' . strtolower($request->name) . '.' . $ext;
            $imagePath = 'images/settings/' . $imageNewName;
            Image::make($request->value)->save(public_path($imagePath));
            $request->merge(['value' => $imagePath]);
        }

        $setting->update($request->all());
        return response(['message' => 'Setting has been updated.'], 200);
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $setting = Setting::find($id);
        $setting->delete();
        return response(['status' => true], 200);
    }
}
