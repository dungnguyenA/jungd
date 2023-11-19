<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list_user(){

        $dataUser = User::all();

        return view('admin.user.list_user',compact('dataUser'));
    }

    public function update_position(REQUEST $request,$id){

        $up_postion = User::find($id);

        $up_postion->role_id = $request->role_id;

        $up_postion->save();

        return redirect()->back();
    }
}
