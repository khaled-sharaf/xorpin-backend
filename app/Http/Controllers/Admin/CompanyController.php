<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    private $patternPhone = "/^\+?\d{10,14}$/";
    private $defaultAvatar = "images/companies-logo/company-default-avatar.jpg";

    public function companies_id()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return response($companies);
    }


    public function index(Request $request)
    {
        $columns = ['index', 'id', 'name', 'email', 'phone', 'address', 'website', 'description', 'logo', 'count_rates', 'visits', 'location', 'face_link', 'tw_link', 'display', 'active', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $active = $request->active;
        $display = $request->display;
        $trashed = $request->trashed;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        // $query = Company::select('*')->orderBy($columns[$column], $dir)->withCount(['rates as count_users_rate']);
        $query = Company::select('*')->orderBy($columns[$column], $dir);


        if ($request->companyId != null) {
            $query->where('company_id', $request->companyId);
        }

        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }

        if ($active != '') {
            $query->where('active', $active);
        }
        if ($display != '') {
            $query->where('display', $display);
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
                    ->orWhere('website', 'like', '%' . $searchValue . '%')
                    ->orWhere('address', 'like', '%' . $searchValue . '%');
                });
            }
        }

        $companies = $query->paginate($length);
        return response(['data' => $companies, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }





    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|between:2,180',
            'description' => 'required|string|between:5,190',
            'email' => 'nullable|email|max:180|unique:companies',
            'phone' => 'nullable|unique:companies|regex:' . $this->patternPhone,
            'website' => 'nullable|string|url|max:190',
            'address' => 'nullable|string|between:5,180',
            'latitude' => 'nullable|numeric|required_with:longitude',
            'longitude' => 'nullable|numeric|required_with:latitude',
            'face_link' => 'nullable|string|url|max:190',
            'tw_link' => 'nullable|string|url|max:190',
            'display' => 'required|in:0,1',
            'active' => 'required|in:0,1',
            'logo' => 'nullable|string'
        ]);

        $data = $request->toArray();

        if (strpos($data['logo'], 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $data['logo'])[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = time() . '-' . Str::kebab(strtolower($data['name'])) . '-company-logo.' . $ext;
            $imagePath = 'images/companies-logo/' . $imageNewName;
            Image::make($data['logo'])
            ->resize(150, 150)
            ->save(public_path($imagePath));
            $data['logo'] = $imagePath;
        }
        $data['user_id'] = auth()->id();
        $data['count_rates'] = 0;
        $createdCompany = Company::create($data);
        return response(['message' => 'Company has been created.', 'data' => $createdCompany]);
    }

    public function show(Request $request)
    {
        $company = Company::find($request->id);
        return response(['company' => $company]);
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $company = Company::find($id);
        $this->validate(request(), [
            'name' => 'required|string|between:2,180',
            'description' => 'required|string|between:5,190',
            'email' => 'nullable|email|max:180|unique:companies,email,'. $id,
            'phone' => 'nullable|regex:' . $this->patternPhone . '|unique:companies,phone,' . $id,
            'website' => 'nullable|string|url|max:190',
            'address' => 'nullable|string|between:5,180',
            'latitude' => 'nullable|numeric|required_with:longitude',
            'longitude' => 'nullable|numeric|required_with:latitude',
            'face_link' => 'nullable|string|url|max:190',
            'tw_link' => 'nullable|string|url|max:190',
            'display' => 'required|in:0,1',
            'active' => 'required|in:0,1',
            'logo' => 'nullable|string'
        ]);

        $data = $request->toArray();

        if (strpos($data['logo'], 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $data['logo'])[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = time() . '-' . Str::kebab(strtolower($data['name'])) . '-company-logo.' . $ext;
            $imagePath = 'images/companies-logo/' . $imageNewName;

            // delete old image if exists
            if ($company->logo != $this->defaultAvatar && $company->logo != null) {
                if (file_exists(public_path($company->logo))) {
                    unlink(public_path($company->logo));
                }
            }

            // add new image to directory
            Image::make($data['logo'])
            ->resize(150, 150)
            ->save(public_path($imagePath));
            $data['logo'] = $imagePath;
        } else if ($data['logo'] == $this->defaultAvatar && ($company->logo != $this->defaultAvatar && $company->logo != null)) {
            if (file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }
        }
        $company->update($data);
        $updatedCompany = Company::withCount(['users', 'products'])->where('id', $request->id)->first();
        return response(['message' => $data['name'] . ' Company has been updated.', 'data' => $updatedCompany]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $company = Company::withTrashed()->where('id', $id)->first();
        if ($company->trashed()) {
            // delete image if exists
            if ($company->logo != 'images/companies-logo/company-default-avatar.jpg' && $company->logo !== null) {
                if (file_exists(public_path($company->logo))) {
                    unlink(public_path($company->logo));
                }
            }
            $company->forceDelete();
        } else {
            $company->delete();
        }
        return response(['status' => true]);
    }


    public function restoreCompany(Request $request)
    {
        $id = $request->id;
        $company_deleted = Company::onlyTrashed()->where('id', $id)->first();
        $company_deleted->restore();
        return response(['status' => true]);
    }
}
