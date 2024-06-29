<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty_and_staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id', // Add 'student_id' to the fillable array
        'name',
        'college',
        'image',
    ];

    public function facultyrecords()
    {
        return $this->hasMany(FacultyRecords::class, 'faculty_id', 'faculty_id');
    }
}
