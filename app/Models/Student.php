<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //this model represets the student
    //it borrows, or it's an extension of from the user model
    use HasFactory;
    protected $fillable = [
        'user_id',
        'programme',
        'attachment_county',
        'registration_number',
        'location_address',
        'recommendation_letter',
        'phone_number',
        'organisation',
        'acceptance_letter',

    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assessors()
    {
        return $this->belongsToMany(Assessor::class, 'student_assessor' )
                ->withPivot('assessment_order','assessment_date')
            ->withTimestamps();
    }


    public function assessments(){
        return $this->hasMany(Assessment::class);
    }
}
