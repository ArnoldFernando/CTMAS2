<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduateSchoolList extends Model
{
    use HasFactory;

    protected $fillable = [
        'graduateschool_id', // Add 'student_id' to the fillable array
        'name',
        'course',
        'image',
    ];
    public function graduateschoolrecords()
    {
        return $this->hasMany(GraduateSchoolRecords::class, 'graduateschool_id', 'graduateschool_id');
    }

    public function computerRecords()
    {
        return $this->hasMany(ComputerRecords::class, 'graduateschool_id', 'graduateschool_id');
    }
}
