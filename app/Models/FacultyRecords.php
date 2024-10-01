<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyRecords extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id', 'time_in', 'time_out'];
    public function faculty()
    {
        return $this->belongsTo(FacultyList::class, 'faculty_id', 'faculty_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
