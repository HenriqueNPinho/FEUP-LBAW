<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $redirectTo = '/projects';

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
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
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_image' => null,
        ]);
    }
    /* ========================================== */
    /* ADMIN                                      */
    /* ========================================== */
    protected function createAdmin(Request $request)
    {
        $sofi = "vou criar filho da puta do admin";
        echo "<script>console.log('Debug Objects: " . $sofi . "' );</script>";

        $this->validator($request->all())->validate();

        $sofi = "depois da";
        echo "<script>console.log('Debug Objects: " . $sofi . "' );</script>";
        return Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $sofi = "criei o filho da puta do admin";
        echo "<script>console.log('Debug Objects: " . $sofi . "' );</script>";
        return redirect()->intended('login');
    }

    public function showAdminRegistrationForm()
    {
        $sofi = "vou mostrar o oregister do admin";
        echo "<script>console.log('Debug Objects: " . $sofi . "' );</script>";
        return view('auth.registeradmin');
    }
}
