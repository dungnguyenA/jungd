<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function list_comment(){
        $list_comment = DB::table('users')
                        ->join('comments', 'comments.user_id','=','users.id')
                        ->join('products','products.id','=','comments.product_id')
                        ->join('images','images.product_id','=','products.id')
                        ->select('users.name','comments.*','products.product_name','images.image_name')
                        ->orderBy('comments.created_at','desc')
                        ->paginate(5);
        return view('admin.comment.list_comment',compact('list_comment'));
    }
}
