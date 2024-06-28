<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecords extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'time_in', 'time_out'];


    public function student()
    {
        return $this->belongsTo(StudentList::class, 'student_id', 'student_id');
    }
}
