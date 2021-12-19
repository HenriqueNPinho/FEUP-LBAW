<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) return redirect('/cards');
        return view('pages.homepage');
    }

}
