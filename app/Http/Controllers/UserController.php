<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        return view('pages.userpage',['user' => $user]);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @return Response
     * 
     */
    public function edit()
    {
        $user = Auth::user();

        return view('pages.edituserpage', ['user' => $user]);
    }

    public function userpageUpdate(Request $request){
        //validation rules

        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255'
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return view('pages.userpage', ['user' => $user])->with('message','User Page Updated');
    }

}