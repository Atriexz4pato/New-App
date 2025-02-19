<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//this model represents the assessor
//tailored to have the details from the user model
class Assessor extends Model
{
    //
    protected $fillable = [
        'employee_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function student(){
        return $this->belongsToMany(Student::class);
    }

    public function assessment(){
        return $this->hasMany(Assessment::class);
    }
}
