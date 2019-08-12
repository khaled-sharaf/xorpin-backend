<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        // $columns = ['index', 'id', 'text_comment', 'positive_product', 'negative_product', 'display', 'user_id', 'product_id', 'created_at'];
        $columns = ['index', 'id', 'text_comment', 'display', 'user_id', 'product_id', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $display = $request->display;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Comment::with(['user', 'product'])->select('*')->orderBy($columns[$column], $dir);

        if ($display != '') {
            $query->where('display', $display);
        }

        if ($request->productId != null) {
            $query->where('product_id', $request->productId);
        }

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
            })->orWhere('text_comment', 'like', '%' . $searchValue . '%')
              ->orWhere('positive_product', 'like', '%' . $searchValue . '%')
              ->orWhere('negative_product', 'like', '%' . $searchValue . '%');
        }

        if (auth()->user()->rule == 2) {
            $query->whereHas('product', function($q) {
                $q->where('company_id', auth()->user()->company_id);
            });
        }

        $comments = $query->paginate($length);
        return response(['data' => $comments, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }


    public function edit(Request $request)
    {
        $comment = Comment::with(['user', 'product'])->find($request->id);
        return response(['comment' => $comment]);
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $comment = Comment::find($id);
        $this->validate(request(), [
            'text_comment' => 'required|string',
            'display' => 'required'
            // 'positive_product' => 'required|string',
            // 'negative_product' => 'required|string',
            // 'user_id' => 'required',
            // 'product_id' => 'required'
        ]);
        $comment->update($request->all());
        return response(['message' => 'Comment has been updated.']);
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $comment = Comment::find($id);
        $comment->delete();
        return response(['status' => true]);
    }
}
