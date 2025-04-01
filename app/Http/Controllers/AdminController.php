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

    //a function to allocate lecturers to students

    public  function assignAssessor(){
        //get All the counties

        $counties =Student::distinct()->pluck('attachment_county')->filter()->sort()->values();

        //get all assessors
        $assessors = Assessor::with('user')->get();

        //initialise filtered students
        $students= collect();
        $selectedCounty= request('county');

        if($selectedCounty){
            $students = Student::where('attachment_county',$selectedCounty)
                ->with('user')
                ->get();
        }

        return view('admin.assign_assessor',compact('assessors','counties','students','selectedCounty'));
    }


    //function to do nthe real assignemnt of assessors to the students
    public function storeAssessorAssignment(Request $request){
        $data = $request->validate([
            'county' => 'required|string|max:255',
            'first_assessor_id'=>'required|string|max:255|exists:assessors,id',
            'second_assessor_id'=>'required|string|max:255|exists:assessors,id',
            'first_assessment_date'=>'required|date|date_format:Y-m-d',
            'second_assessment_date'=>'required|date|date_format:Y-m-d|after:first_assessment_date',
        ]);
        $county = $request->county;
        $firstAssessor =Assessor::find($request->first_assessor_id);
        $secondAssessor =Assessor::find($request->second_assessor_id);

//        if (!$firstAssessor->hasCounty($county) || !$secondAssessor->hasCounty($county)) {
//            return redirect()->back()->withErrors(['county' => 'Assessors must be assigned to the selected county (' . $county . ').']);
//        }
        //get students from the stated county
        $students = Student::where('attachment_county',$county)->get();

        if($students->isEmpty()){
            return redirect()->back()->withErrors(['students'=>'No students in the stated County']);
        }

        //assign assessors to all students

        foreach ($students as $student) {
            $existingAssessors = $student->assessors()->count();
            if($existingAssessors ==2){
                continue; //skip students already assigned assessors
            }
            if($existingAssessors <1){
                $student->assessors()->attach($request->first_asessor_id, [
                    'assessment_order'=>1,
                    'assessment_date'=>$request->first_assesment_date,

                ]);
            }

            if($existingAssessors<2){
                $student->assessors()->attach($request->second_assessor_id,[
                    'assessment_order'=>2,
                    'assessment_date'=>$request->second_assessment_date,
                ]);
            }
        }



        return redirect()->back()->with('success', 'Assessors assigned to students successfully!');

    }
}
