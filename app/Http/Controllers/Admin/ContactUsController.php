<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        $columns = ['id', 'name', 'email', 'message', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $searchValue = $request->input('search');
        $query = ContactUs::select('*')->orderBy($columns[$column], $dir);

        if ($from_date != '') {
            $query->whereDate('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $query->whereDate('created_at', '<=', $to_date);
        }

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }
        $settings = $query->paginate($length);
        return response(['data' => $settings, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }


    public function destroy(Request $request)
    {
        ContactUs::destroy($request->id);
        return response(['status' => true]);
    }
}
