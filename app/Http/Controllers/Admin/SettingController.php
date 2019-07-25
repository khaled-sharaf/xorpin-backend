<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Str;

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

        // except carousel
        $query->where('name', '!=', 'carousel');

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('slug', 'like', '%' . $searchValue . '%');
            });
        }
        $settings = $query->paginate($length);
        return response(['data' => $settings, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
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
            $imageNewName = uniqid('setting-image-') . '-' . Str::kebab(strtolower($request->name)) . '.' . $ext;
            $imagePath = 'images/settings/' . $imageNewName;
            Image::make($request->value)->save(public_path($imagePath));
            $request->merge(['value' => $imagePath]);
        }
        Setting::create($request->all());
        return response(['message' => 'Setting has been created.']);
    }


    public function edit(Request $request)
    {
        $setting = Setting::find($request->id);
        return response(['setting' => $setting]);
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
            $imageNewName = uniqid('setting-image-') . '-' . Str::kebab(strtolower($request->name)) . '.' . $ext;
            $imagePath = 'images/settings/' . $imageNewName;
            Image::make($request->value)->save(public_path($imagePath));
            $request->merge(['value' => $imagePath]);
        }

        $setting->update($request->all());
        return response(['message' => 'Setting has been updated.']);
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $setting = Setting::find($id);
        if (strpos($setting->value, 'images/settings/') === 0) {
            if (file_exists(public_path($setting->value))) {
                unlink(public_path($setting->value));
            }
        }
        $setting->delete();
        return response(['status' => true]);
    }



    public function editCarousel(Request $request) {
        $carousel = Setting::where('name', 'carousel')->first();
        return response(['carousel' => $carousel]);
    }




    public function updateCarousel(Request $request) {
        $id = $request->id;
        $this->validate(request(), [
            'value' => 'required|array'
        ], [], [
            'value' =>  app()->getLocale() == 'ar' ? 'صور الصفحة الرئيسية' : 'carousel'
        ]);
        $data = $request->except(['deleted_carousel_images']);

        $directory = 'images/carousel';

        if (!is_dir(public_path($directory))) {
            \File::makeDirectory($directory);
        }

        // handel carousel
        // delete images in array [carousel deleted by user]
         $deleted_carousel_images = collect($request->deleted_carousel_images)->filter(function ($value) use ($directory) {
             return strpos($value['url'], $directory) === 0;
         });
         if ($deleted_carousel_images->count() > 0) {
            foreach ($deleted_carousel_images as $image) {
                if (file_exists(public_path($image['url']))) {
                    unlink(public_path($image['url']));
                }
            }
         }

        /*================================================*/
        // save new and old images
         $carousel = collect($request->value);
         $galllery_new = $carousel->filter(function ($value) use ($directory) {
            return strpos($value['url'], $directory) === false;
         });
         $galllery_old = $carousel->filter(function ($value) use ($directory) {
            return strpos($value['url'], $directory) === 0;
         });
        /*================================================*/
        $carousel_saved = [];
        // save new image if exists new image
        if ($galllery_new->count() > 0) {
            foreach ($galllery_new as $image) {
                $get_ext = explode(';', explode('/', $image['url'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName =  uniqid('carousel-image-') . '.' . $ext;
                $imagePath = $directory . '/' . $imageNewName;
                if (is_dir(public_path($directory))) {
                    Image::make($image['url'])->save(public_path($imagePath));
                    $carousel_saved[] = $imagePath;
                }
            }
        }
        /*================================================*/
        if ($galllery_old->count() > 0) {
            foreach ($galllery_old as $value) {
                $carousel_saved[] = $value['url'];
            }
        }
        if (count($carousel_saved) > 0) {
            $data['value'] = implode(',', $carousel_saved);
        } else {
            $data['value'] = null;
        }
        /****************************************************************************/
        $carouselModel = Setting::find($request->id);
        $carouselModel->update($data);
        return response(['data' => $data]);
    }
}
