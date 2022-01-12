<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin;

class AdminCOntroller extends Controller
{
    public function showAdminPage()
    {
        if (!Auth::check()) return redirect('/login');
        
        return view('pages.admin-homepage');
    }
}