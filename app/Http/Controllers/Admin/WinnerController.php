<?php

namespace App\Http\Controllers\Admin;

use App\Winner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WinnerController extends Controller
{

    public function index(Request $request)
    {
        $columns = ['index', 'id', 'user_id', 'product_id', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Winner::select('*')->orderBy($columns[$column], $dir);

        if ($from_date != '') {
            $query->whereDate('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $query->whereDate('created_at', '<=', $to_date);
        }
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->whereHas('user', function($q) use ($searchValue) {
                    $q->where('name', 'like', '%' . $searchValue . '%');
                });
            })->orWhere(function($query) use ($searchValue) {
                $query->whereHas('product', function($q) use ($searchValue) {
                    $q->where('name', 'like', '%' . $searchValue . '%');
                });
            });
        }
        if (auth()->user()->rule == 2) {
            $query->whereHas('product', function($q) {
                $q->where('company_id', auth()->user()->company_id);
            });
        }

        $winners = $query->paginate($length);
        return response(['data' => $winners, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }



    public function store(Request $request)
    {
        $this->validate(request(), [
            'user_id' => 'required',
            'product_id' => 'required'
        ]);
        Winner::create($request->all());
        return response(['message' => 'Winner has been created.']);
    }


    public function edit(Request $request)
    {
        $winner = Winner::find($request->id);
        return response(['winner' => $winner]);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $winner = Winner::find($id);
        $this->validate(request(), [
            'user_id' => 'required',
            'product_id' => 'required'
        ]);
        $winner->update($request->all());
        return response(['message' => 'Winner has been updated.']);
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $winner = Winner::find($id);
        $winner->delete();
        return response(['status' => true]);
    }
}
