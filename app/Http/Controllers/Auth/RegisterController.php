<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Company;
use App\Models\CompanyInvite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

    use RegistersUsers;

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->profile_image = null;
        $user->is_admin = $data['is_admin'];
        $user->save();

        if($user->is_admin == 1){
            $company = new Company();
            $company->name = $data['companyName'];
            $company->save();
            $user->company_id = $company->id;
            $user->save();
        }

        $invite=CompanyInvite::where('token',$data['companyInviteToken'])->first();
        if($invite==null) return $user;
        if($invite->email!=$user->email) return $user;
        $company=Company::find($invite->company_id);
        $user->companies()->attach($company);
        $invite->delete();
        return $user;
    }


    public function showAdminRegistrationForm(){
        return view ('auth.register-admin');
    }

    public function redirect()
    {
        return view ('auth.register-redirect');
    }

    public function redirectWithToken(Request $request){
        
        return redirect('/register')->with('companyInviteToken',$request['token']);
    }
}
