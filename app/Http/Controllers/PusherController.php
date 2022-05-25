<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pusher;

class PusherController extends Controller
{
    public function save(Request $request)
    {
        $push_id=$request->input('sid');
        $role=Auth::user()->role;
        $user_id=Auth::user()->user_id;
        $count=Pusher::where([['pusher_id',$push_id],['role',$role],['user_id',$user_id]])->count();
        if($count==0)
        {
            $pusher=new Pusher();
            $pusher->pusher_id=$push_id;
            $pusher->role=$role;
            $pusher->user_id=$user_id;
            $pusher->save();
        }
    }
}
