<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Course;
use App\Models\FacultyList;
use App\Models\FacultyRecords;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{

    // students
    public function StudentRecordsPDF(Request $request)
    {
        ini_set('memory_limit', '512M');      // Adjust as needed
        ini_set('max_execution_time', 300);   // Set to 5 minutes or longer
            // Get the selected college, start date, and end date from the request
        $selectedCollege = $request->input('college');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Adjust the end date to include the entire day
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

        // Fetch student records with related student details, optionally filtered by the selected college and date range
        $query = StudentRecords::with('student')
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->whereBetween('student_records.created_at', [$startDate, $endDate])
        ->where('student_lists.status', 'undergraduateschool')
        ->orderBy('student_records.created_at', 'asc')
        ->select('student_records.*');

        if ($selectedCollege) {
            $query->whereHas('student', function ($query) use ($selectedCollege) {
                $query->where('college_id', $selectedCollege);
            });
        }

        $studentRecords = $query->get();

        // Fetch colleges for the form
        $colleges = College::all(); // Fetch all colleges

        // Pass data to the view
        $data = [
            'studentRecords' => $studentRecords,
            'colleges' => $colleges, // Include colleges in the data
        ];

        // Create a filename based on the selected college and date range
        $filename = ($selectedCollege ? $selectedCollege : 'all') . '_student_records_' . $startDate . '_to_' . $endDate->format('Y-m-d') . '.pdf';

        // Load the view and pass data
        $pdf = PDF::loadView('admin.student.records.export-records', $data)->setPaper([0, 0, 612, 936]);

        // Return the generated PDF for download with the dynamic filename
        return $pdf->download($filename);
    }



    // faculties
    public function FacultyRecordsPDF(Request $request)
    {
        // Get the selected college, start date, and end date from the request
        $selectedCollege = $request->input('college');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Adjust the end date to include the entire day
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

        // Fetch student records with related student details, optionally filtered by the selected college and date range
        $query = FacultyRecords::with('faculty')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'asc');

        if ($selectedCollege) {
            $query->whereHas('faculty', function ($query) use ($selectedCollege) {
                $query->where('college_id', $selectedCollege);
            });
        }

        $facultyRecords = $query->get();

        // Pass data to the view
        $data = [
            'facultyRecords' => $facultyRecords
        ];

        // Create a filename based on the selected college and date range
        $filename = ($selectedCollege ? $selectedCollege : 'all') . '_faculty_records_' . $startDate . '_to_' . $endDate->format('Y-m-d') . '.pdf';

        // Load the view and pass data
        $pdf = PDF::loadView('admin.faculty.records.export-records', $data)->setPaper([0, 0, 612, 936]);

        // Return the generated PDF for download with the dynamic filename
        return $pdf->download($filename);
    }



    // graduate school
    public function GradschoolRecordsPDF(Request $request)
    {
        // Get the selected college, start date, and end date from the request
        $selectedCollege = $request->input('course');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Adjust the end date to include the entire day
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

        // Fetch student records with related student details, optionally filtered by the selected college and date range
        $query = StudentRecords::with('student')
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->whereBetween('student_records.created_at', [$startDate, $endDate])
        ->where('student_lists.status', 'graduateschool')
        ->orderBy('student_records.created_at', 'asc')
        ->select('student_records.*');

        if ($selectedCollege) {
            $query->whereHas('student', function ($query) use ($selectedCollege) {
                $query->where('course_id', $selectedCollege);
            });
        }

        $GradschoolRecords = $query->get();

        // Fetch colleges for the form
        $courses = Course::all(); // Fetch all colleges

        // Pass data to the view
        $data = [
            'GradschoolRecords' => $GradschoolRecords,
            'courses' => $courses, // Include colleges in the data
        ];

        // Create a filename based on the selected college and date range
        $filename = ($selectedCollege ? $selectedCollege : 'all') . '_Gradschool_records_' . $startDate . '_to_' . $endDate->format('Y-m-d') . '.pdf';

        // Load the view and pass data
        $pdf = PDF::loadView('admin.graduateschool.records.export-records', $data)->setPaper([0, 0, 612, 936]);

        // Return the generated PDF for download with the dynamic filename
        return $pdf->download($filename);
    }



}
