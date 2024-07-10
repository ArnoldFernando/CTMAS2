<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\FacultyRecords;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DB;

class PDFController extends Controller
{
    public function StudentRecordsPDF(Request $request)
    {
        // Get the selected college, start date, and end date from the request
        $selectedCollege = $request->input('college');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Adjust the end date to include the entire day
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

        // Fetch student records with related student details, optionally filtered by the selected college and date range
        $query = StudentRecords::with('student')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($selectedCollege) {
            $query->whereHas('student', function ($query) use ($selectedCollege) {
                $query->where('college', $selectedCollege);
            });
        }

        $studentRecords = $query->get();

        // Pass data to the view
        $data = [
            'studentRecords' => $studentRecords
        ];

        // Create a filename based on the selected college and date range
        $filename = ($selectedCollege ? $selectedCollege : 'all') . '_student_records_' . $startDate . '_to_' . $endDate->format('Y-m-d') . '.pdf';

        // Load the view and pass data
        $pdf = PDF::loadView('admin.student.export-records', $data)->setPaper([0, 0, 612, 936]);

        // Return the generated PDF for download with the dynamic filename
        return $pdf->download($filename);
    }

    public function StudentReports()
    {
        // Fetch all unique courses from student_lists table
        $courses = StudentList::select('course', 'college')
            ->distinct()
            ->get();

        $totals = [];

        // Calculate total records for each course
        foreach ($courses as $course) {
            $totalRecords = StudentRecords::join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
                ->where('student_lists.course', $course->course)
                ->count();

            $totals[$course->course] = $totalRecords;
        }

        // Generate PDF using dompdf
        $pdf = PDF::loadView('admin.student.reports-pdf', compact('courses', 'totals'));

        // Download the PDF file with the report name
        return $pdf->download('student-attendance-report.pdf');
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
