<?php

namespace App\Http\Controllers;

use App\Models\Assessor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\String\u;

class AdminController extends Controller
{
    //
    //method that renders the admin dashboard upon log in
    public function dashboard()
    {
        $studentsCount = Student::all()->count();
        $assessorsCount = Assessor::all()->count();
//         dd($studentsCount, $assessorsCount);

        return view('admin.dashboard',compact('studentsCount','assessorsCount'));

    }

    public function manageAssessors(){
        $assessors = Assessor::paginate(10);
        return view('admin.assessor_management',compact('assessors'));
    }

    ////manage stiudents
    public function manageStudents(){
        $students = Student::paginate(10);
        return view('admin.student_management',compact('students'));
    }

         //this method is used to create a new assessor in the system
        //this method pushes the user data entered for a new assessor to the necessary tables
    public function storeAssessor(Request $request){

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'employee_id' => 'required|string|max:255|unique:assessors',
                'department' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255|unique:users',
            ]);



            //persist the assessor details to  users table
            $user= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'department' => $data['department'],
                'phone_number' => $data['phone_number'],
                'role' => 'assessor',
                'password' => Hash::make('password'),


            ]);
            Log::info('Created a new userID'.$user->id);


            //persist the assessor extra details to the assessor table
            $assessor=Assessor::create([
                'user_id' => $user->id,
                'employee_id' => $data['employee_id'],
            ]);

            return redirect()->route('admin.manage_assessors')->with('success','Assessor added successfully');


    }

    //edit the assessor

    public function editAssessor(Assessor $assessor){
        return view('admin.createAssessor',compact('assessor'));
    }

    public function updateAssessor(Request $request, Assessor $assessor)
    {
        $user = User::find($assessor->user_id);

        if (!$user) {
            return redirect()->route('admin.manage_assessors')->with('error', 'Associated user not found.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|max:50|unique:assessors,employee_id,'.$assessor->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|max:20',
            'department' => 'required|string',
            'role' => 'required|string',
        ]);

        $user->update([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'department'=>$validated['department'],
            'phone_number'=>$validated['phone_number'],
            'role'=>$validated['role'],
        ]);

        $assessor->update([
            'employee_id' => $validated['employee_id'],
        ]);

        return redirect()->route('admin.manage_assessors')->with('success', 'Assessor updated successfully!');
    }

    public function destroyAssessor(Assessor $assessor)
    {
        $assessor->delete();
        return redirect()->route('admin.manage_assessors')->with('success', 'Assessor deleted successfully!');
    }
}
