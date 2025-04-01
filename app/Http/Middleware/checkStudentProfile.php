<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class checkStudentProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user= auth()->user();

        if($user && $user->role==='student'){
            $student = $user->student;
            Log::info('Student Check: ', ['user_id' => $user->id, 'student' => $student, 'fields' => [
                'registration_number' => $student ? $student->registration_number : null,
                'programme' => $student ? $student->programme : null,
                'attachment_county' => $student ? $student->attachment_county : null,
                'location_address' => $student ? $student->location_address : null,
                'recommendation_letter' => $student ? $student->recommendation_letter : null,
                'acceptance_letter' => $student ? $student->acceptance_letter : null,
            ]]);

            if(!$student|| !$student->registration_number || !$student->programme || !$student->attachment_county || !$student->location_address ){
                    //redirect if not already on dashboard
                if($request->route()->getName() != 'student.dashboard'){
                    return redirect()->route('student.dashboard')->with('showModal', true);
                }
            }
        }

        return $next($request);
    }
}
