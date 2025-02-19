<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function dashboard()
    {
        return view('student.dashboard');
    }

    //this method fetches the details of a student, renders them and then updates the student attachment details
    public function editAttachment($id)
    {
        $user_id= Auth::user()->id;
        $student = Student::where('user_id', $user_id)->first();

        return view('student.updateAttachment', compact('student'));
    }

    //this update the database of student attachment details
    public function updateAttachment(Request $request, $id){
        $user_id= Auth::user()->id;
        $student = Student::where('user_id', $user_id)->first();

        $data=$request->validate([
            'programme'=>'required|string|max:255',
            'attachment_county'=>'required|string|max:255',
            'address'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
        ]);


        $student->update($data);
        return redirect()->route('student.dashboard')->with('success', 'Attachment details updated successfully');
    }

    //upload the acceptance letter

    public function uploadAcceptanceLetter(Request $request, $id){
        $user_id= Auth::user()->id;
        $student =Student::where('user_id', $user_id)->first();

        $letter=$request->validate([
            'acceptance_letter'=>'required|mimes:pdf|max:2048',
        ]);

        if($request->hasFile('acceptance_letter')){
            $letter=$request->file('acceptance_letter');
            $filename=time().'.'.$letter->getClientOriginalExtension();
            $letter->move('uploads/acceptance_letters/', $filename);

            Student::update(['acceptance_letter', $filename]);
        }
    }

    public function uploadRecommendationLetter(Request $request, $id){
        $user_id= Auth::user()->id;
        $student =Student::where('user_id', $user_id)->first();

        $letter=$request->validate([
            'recommendation_letter'=>'required|mimes:pdf|max:2048',
        ]);

        if($request->hasFile('recommendation_letter')){
            $letter=$request->file('recommendation_letter');
            $filename=time().'.'.$letter->getClientOriginalExtension();
            $letter->move('uploads/recommendation_letters/', $filename);

            Student::update(['recommendation_letter', $filename]);
        }
    }
}
