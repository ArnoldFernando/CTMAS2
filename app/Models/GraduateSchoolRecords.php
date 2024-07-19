<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduateSchoolRecords extends Model
{
    use HasFactory;
    protected $fillable = ['faculty_id', 'time_in', 'time_out'];
    public function graduateschool()
    {
        return $this->belongsTo(GraduateSchoolList::class, 'graduateschool_id', 'graduateschool_id');
    }
}
