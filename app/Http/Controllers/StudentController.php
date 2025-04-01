<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    public function dashboard()
    {
        set_time_limit(60);

                $user = auth()->user();
                Log::info("Start.......");

        $student = $user->student()->with(['assessors', 'assessments'])->first();
        Log::info("End........");

        Log::info("Checking ....");
        //check if student rpofile is complete
        $showModal = session('showModal', false);
        $showModal = !$student || !$student->registration_number || !$student->programme || !$student->attachment_county || !$student->location_address ;
        if(!$showModal && !$student || !$student->registration_number || !$student->programme || !$student->attachment_county || !$student->location_address ){
            $showModal = true;
        }
        Log::info("Endd checking..");




        return view('student.dashboard' ,compact( 'showModal', 'student' ));
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
            'location_address'=>'required|string|max:255',
        ]);


        $student->update($data);
        return redirect()->route('student.dashboard')->with('success', 'Attachment details updated successfully');
    }

    public function updateProfile(Request $request){
        $user =auth()->user();

        $validatedData = $request->validate([
            'registration_number'=>'required|string|max:255',
            'programme'=>'required|string|max:255',
            'attachment_county'=>'required|string|max:255',
            'location_address'=>'required|string|max:255',
            'organisation'=>'required|string|max:255',
        ]);
        $data = $validatedData;
        if ($user->student) {
            $user->student->update($data);
        }else{
            Student::create($data,['user_id'=>$user->id]);
        }

        return redirect()->route('student.dashboard')->with('success', 'Attachment details updated successfully');

    }

    //display the page for uploading the documents, acceptance letter and recommendation  letter

    public function uploadDocuments(){

        return view('student.uploadDocuments');
    }


    //upload the acceptance letter
    public function uploadAcceptanceLetter(Request $request)
    {
        $student = auth()->user()->student;

        // Validate the request
        $request->validate([
            'acceptance_letter' => 'required|file|mimes:pdf|max:2048', // Max 2MB
        ]);

        // Handle file upload
        if ($request->hasFile('acceptance_letter')) {
            // Delete old acceptance letter if exists
            if ($student->acceptance_letter_path) {
                Storage::disk('public')->delete($student->acceptance_letter_path);
            }

            // Store the new file
            $file = $request->file('acceptance_letter');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('acceptance_letters', $filename, 'public');

            // Update the student's record
            $student->update([
                'acceptance_letter' => $path,
            ]);

            return redirect()->back()->with('success', 'Acceptance letter uploaded successfully.');
        }

        return redirect()->back()->withErrors(['acceptance_letter' => 'Failed to upload the acceptance letter.']);
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

    public  function myAssessors(){
        $assessors=auth()->user()->student->assessors;
        return view('student.myAssessors',compact('assessors'));
    }

    public function assessments(){
        
    }
}
