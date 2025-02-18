<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    //method that renders the admin dashboard upon log in
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
