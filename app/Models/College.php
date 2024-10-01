<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $primaryKey = 'college_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'colleges';

    // Allow mass assignment for these fields
    protected $fillable = [
        'college_id',
        'college_name',
    ];

     // A college can have many courses
     public function courses()
     {
         return $this->hasMany(Course::class);
     }

     // A college can have many students
     public function students()
     {
         return $this->hasMany(StudentList::class);
     }

     // A college can have many faculties
     public function faculty()
     {
         return $this->hasMany(FacultyList::class);
     }

     // A college can have many graduate schools
}
