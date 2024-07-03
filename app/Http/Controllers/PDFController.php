<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\FacultyRecords;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function StudentRecordsPDF()
    {
        // Fetch all student records with related student details
        $studentRecords = StudentRecords::with('student')->get();

        // Pass data to the view
        $data = [
            'studentRecords' => $studentRecords
        ];

        // Load the view and pass data
        $pdf = PDF::loadView('admin.student.export-records', $data);

        // Return the generated PDF for download
        return $pdf->download('student_records.pdf');
    }

    public function FacultyRecordsPDF()
    {
        // Fetch all student records with related student details
        $facultyRecords = FacultyRecords::with('faculty')->get();

        // Pass data to the view
        $data = [
            'facultyRecords' => $facultyRecords
        ];

        // Load the view and pass data
        $pdf = PDF::loadView('admin.faculty.export-records', $data);

        // Return the generated PDF for download
        return $pdf->download('Faculty_records.pdf');
    }
}
