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

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        if($request->image != null) {
            //$imageName = 'user-' . $id . '.'.$request->image->getClientOriginalExtension();
            //$request->image->move(public_path('img/users/'), $imageName);
    
            //$request->merge(['img' => $imageName]);
        }

        Flash::success('User updated successfully.');

        return redirect(route('pages.userpage', $user));
    }

}