<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', // Add 'student_id' to the fillable array
        'name',
        'course',
        'college',
        'image',
    ];

    public function records()
    {
        return $this->hasMany(StudentRecords::class, 'student_id', 'student_id');
    }
    public function computerRecords()
    {
        return $this->hasMany(ComputerRecords::class, 'student_id', 'student_id');
    }
}
