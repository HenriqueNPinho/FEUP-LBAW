<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Image;
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    public function userpageUpdate(Request $request){
        //validation rules
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->profile_description = $request['profile_description'];

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $fileNameExtension = ".jpg";

            $user->profile_image = 'images/avatars/' . (Auth::user()->id). '.jpg';
            echo("<script>console.log('PATH: " . $user->profile_image . "');</script>");

            $file->move(public_path('/images/avatars'), (Auth::user()->id) . $fileNameExtension);
        }
        else{
            $sofia = "não recebi imagem";
            echo("<script>console.log('PATH: " . $sofia . "');</script>");
        }

        $user->save();
        return view('pages.userpage', ['user' => $user]);
    }

    public function deletePhoto(Request $request){
        $sofia = "estou na função que apaga a foto";
        echo("<script>console.log('PATH: " . $sofia . "');</script>");

        $user = Auth::user();
        File::delete($user->profile_image);
        $user->profile_image = '/images/avatars/profile-pic-2.png';

        return view('pages.edituserpage', ['user' => $user]);
    }

    public function delete(Request $request) 
    {
        $user = Auth::user();
        File::delete($user->profile_image);
        Auth::logout();
        $user->delete();
        
        return Redirect::route('homepage')->with('global', 'Your account has been deleted!'); 
    }

    public function getNotifications()
    {
        $user = Auth::user();
        return $user->projectInvitations;
    }
}