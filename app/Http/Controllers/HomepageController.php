<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Company;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->is_admin){
                return redirect('/adminHomePage');
            }
            else if(!($user->is_admin)){
                return redirect('/projects');
            }
        }

        return view('pages.homepage');
    }

    public function showFaqPage(){
        return view('pages.faq');
    }
    public function showAboutUsPage(){
        return view('pages.about-us');
    }
}
