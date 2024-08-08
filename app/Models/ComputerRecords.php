<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerRecords extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id', 'student_id', 'graduateschool_id', 'time_in', 'time_out'];

    public function faculty()
    {
        return $this->belongsTo(Faculty_and_staff::class, 'faculty_id', 'faculty_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentList::class, 'student_id', 'student_id');
    }

    public function graduateSchool()
    {
        return $this->belongsTo(GraduateSchoolList::class, 'graduateschool_id', 'graduateschool_id');
    }


}
