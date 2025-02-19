<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    //method that renders the admin dashboard upon log in
    public function dashboard()
    {
        return view('admin.dashboard');

    }
        //this method is used to create a new assessor in the system
         public function createAssessor(){

             return view('admin.createAssessor');


        }

        public function storeAssessor(Request $request){
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:assessors',
                'employee_id' => 'required|string|max:255|unique:assessors',
                'department' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
            ]);

            //persist the assessor details to  users table
            $user= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'department' => $data['department'],
                'phone_number' => $data['phone_number'],


            ]);
            //persist the assessor extra details to the assessor table
            $user->assessor()->create([
                'user_id' => $user->id,
                'employee_id' => $data['employee_id'],
            ]);
            return redirect()->route('admin.dashboard')->with('success','Assessor added successfully');


        }
}
