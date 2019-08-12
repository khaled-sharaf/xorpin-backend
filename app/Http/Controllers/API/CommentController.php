<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use App\Product;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'comment' => 'required|string|min:10|max:5000'
        ]);
        $status = true;

        $comment = $request->comment;
        $product_id = $request->product_id;
        $user_id = $request->user()->id;

        Comment::create([
            'text_comment' => $comment,
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);
        return response(['status' => $status]);
    }




    public function update($id, Request $request)
    {
        $request->validate([
            'comment' => 'required|string|min:10|max:5000'
        ]);
        $status = true;
        $comment = $request->comment;
        $commentModel = Comment::find($id);
        if ($commentModel != null) {
            $commentModel->update(['text_comment' => $comment]);
        } else {
            $status = false;
        }
        return response(['status' => $status]);
    }


    public function destroy($id)
    {
        $status = true;
        $commentModel = Comment::find($id);
        if ($commentModel != null) {
            $commentModel->delete();
        } else {
            $status = false;
        }
        return response(['status' => $status]);
    }
}
