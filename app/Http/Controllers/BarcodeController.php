<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use Illuminate\Http\Request;
use DNS1D;
use Milon\Barcode\Facades\DNS1DFacade;

class BarcodeController extends Controller
{
    public function studentBarcode()
    {

        $students = StudentList::all();
        // Generate barcode for each student
        $students->map(function ($student) {
            $student->barcode = DNS1DFacade::getBarcodePNG($student->student_id, 'C39');
            return $student;
        });
        return view('admin.student.student-barcode', compact('students'));
    }
}
