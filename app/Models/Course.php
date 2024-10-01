<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    protected $fillable = ['course_name', 'college_id', 'type'];

    // A course belongs to a college
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'college_id');
    }

    // A course can have many students

    public function students()
    {
        return $this->hasMany(Studentlist::class, 'student_id');
    }
}
