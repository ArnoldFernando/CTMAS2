<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyList extends Model
{
    use HasFactory;

    protected $primaryKey = 'faculty_id';  // Use string as primary key
    public $incrementing = false;  // Non-incrementing key
    protected $keyType = 'string';

    protected $fillable = ['faculty_id', 'first_name', 'middle_initial', 'last_name', 'image', 'college_id'];



}
