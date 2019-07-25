<?php

namespace App\Http\Controllers\Admin;

use App\ProductType as Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    public function index(Request $request)
    {
        $columns = ['index', 'id', 'name', 'display', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $display = $request->display;
        $trashed = $request->trashed;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Type::select('*')->orderBy($columns[$column], $dir);

        // handel types trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
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
                    ->orWhere('id', $searchValue);
                });
            }
        }
        $types = $query->paginate($length);
        return response(['data' => $types, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }



    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|between:2,50',
            'display' => 'required|in:0,1'
        ]);
        $request->merge(['user_id' => auth()->id()]);
        Type::create($request->all());
        return response(['message' => 'Products type has been created.']);
    }


    public function edit(Request $request)
    {
        $type = Type::find($request->id);
        return response(['proType' => $type]);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $type = Type::find($id);
        $this->validate(request(), [
            'name' => 'required|string|between:2,50',
            'display' => 'in:0,1'
        ]);
        $type->update($request->all());
        return response(['message' => 'Products type has been updated.']);
    }





    public function destroy(Request $request)
    {
        $id = $request->id;
        $type = Type::withTrashed()->where('id', $id)->first();
        if ($type->trashed()) {
            $type->forceDelete();
        } else {
            $type->delete();
        }
        return response(['status' => true]);
    }


    public function restoreType(Request $request)
    {
        $id = $request->id;
        $type_deleted = Type::onlyTrashed()->where('id', $id)->first();
        $type_deleted->restore();
        return response(['status' => true]);
    }


    public function allTypesUseInSelectBox() {
        $types = Type::orderBy('id', 'desc')->get();
        return response(['types' => $types]);
    }
}
