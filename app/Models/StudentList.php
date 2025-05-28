<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    protected $primaryKey = 'student_id';  // Use string as primary key
    public $incrementing = false;  // Non-incrementing key
    protected $keyType = 'string';

    protected $fillable = ['student_id', 'first_name', 'middle_initial', 'last_name', 'year', 'sex', 'image', 'college_id', 'course_id', 'status'];


    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    // A student belongs to a course
    public function course()
    {
        // Adjust the foreign key if necessary
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    // A student can have many records
    public function records()
    {
        return $this->hasMany(StudentRecords::class, 'student_id', 'student_id');
    }


    // public function records()
    // {
    //     return $this->hasMany(StudentRecords::class, 'student_id', 'student_id');
    // }
    // public function computerRecords()
    // {
    //     return $this->hasMany(ComputerRecords::class, 'student_id', 'student_id');
    // }
}
