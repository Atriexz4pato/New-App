<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessorController extends Controller
{
    //
    //,method that renders the assessor dashboard upon log in
    public function dashboard()
    {
        return view('assessor.dashboard');
    }

    public function createAssessor(){
            $assessor = null;
        return view('admin.createAssessor', compact('assessor'));


    }
}
