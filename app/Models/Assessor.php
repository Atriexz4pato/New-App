<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//this model represents the assessor
//tailored to have the details from the user model
class Assessor extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'user_id',
        'counties'
    ];

    protected $casts = [
        'counties' => 'array',
    ];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function student(){
        return $this->belongsToMany(Student::class, 'student_assessor')
            ->withPivot('assessment_order', 'assessment_date')
            ->withTimestamps();
    }


    // Helper method to check if the assessor is assigned to a specific county
    public function hasCounty($county){
        return in_array($county, $this->counties?? []);
    }
}
