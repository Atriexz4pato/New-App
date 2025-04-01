<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //

    protected $fillable = [
        'student_id',
        'assessor_id',
        'student_assessor_id',
        'score',
        'comments',


    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function assessor(){
        return $this->belongsTo(Assessor::class);
    }
}
