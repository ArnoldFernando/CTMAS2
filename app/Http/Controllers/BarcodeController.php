<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use Illuminate\Http\Request;
use DNS1D;

class BarcodeController extends Controller
{
    public function studentBarcode()
    {
        // Retrieve all students
        $students = StudentList::all();

        // Generate barcode for each student
        $students->map(function ($student) {
            $student->barcode = DNS1D::getBarcodePNG($student->student_id, 'C39');
            return $student;
        });

        return view('admin.student.student-barcode', compact('students'));
    }
}
