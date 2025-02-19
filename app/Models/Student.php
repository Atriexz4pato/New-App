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
        'address',
        'recommendation_letter',
        'phone_number'

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
