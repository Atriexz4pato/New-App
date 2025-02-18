<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //this model represets the student
    //it borrows or its an extension of from the user model

    protected $fillable = [
        'user_id',
        'programme',
        'attachment_county',
        'registration_number',
        'address',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function assessors()
    {
        return $this->belongsToMany(Assessor::class );
    }

    public function assessment(){
        return $this->hasMany(Assessment::class);
    }
}
