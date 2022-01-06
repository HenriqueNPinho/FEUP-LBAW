<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $output = "estou no admin home page controller yeyyyyy";
            echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
            return redirect('/adminHome');
        }
        return view('pages.adminhome');
    }
}
