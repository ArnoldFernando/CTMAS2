<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\FacultyRecords;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function StudentReports(Request $request)
    {
        // Define mappings for colleges and courses
        $collegeMappings = [
            'CBEA' => 'College of Business, Entrepreneurship and Accountancy',
            'CCJE' => 'College of Criminal Justice Education',
            'CHM' => 'College of Hospitality Management',
            'CFAS' => 'College of Fisheries and Aquatic Science',
            'CIT' => 'College of Industrial Technology',
            'CICS' => 'College of Information and Computing Sciences',
            'CTED' => 'College of Teacher Education',
        ];

        // Get the date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Determine the school year and semester based on the start date
        $startMonth = (int) date('m', strtotime($startDate));
        $startYear = (int) date('Y', strtotime($startDate));
        $schoolYear = '';
        $semester = '';

        if ($startMonth == 7) {
            // Vacation period in July
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'Vacation';
        } else if ($startMonth >= 8 && $startMonth <= 12) {
            // First semester
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'First Semester';
        } else if ($startMonth >= 1 && $startMonth <= 6) {
            // Second semester
            $schoolYear = ($startYear - 1) . '-' . $startYear;
            $semester = 'Second Semester';
        }

        // Fetch all courses grouped by college
        $allCourses = StudentList::select('college', 'course')
            ->distinct()
            ->get()
            ->groupBy('college');

        // Fetch the count of student records grouped by course and college within the date range
        $courseCounts = StudentList::select('student_lists.course', 'student_lists.college', DB::raw('COUNT(student_records.id) as total'))
            ->leftJoin('student_records', function ($join) use ($startDate, $endDate) {
                $join->on('student_lists.student_id', '=', 'student_records.student_id')
                    ->whereBetween('student_records.created_at', [$startDate, $endDate]);
            })
            ->groupBy('student_lists.course', 'student_lists.college')
            ->get()
            ->keyBy(function ($item) {
                return $item->college . '-' . $item->course;
            });

        // Prepare the data for the view
        $data = [];
        foreach ($allCourses as $college => $courses) {
            foreach ($courses as $course) {
                $key = $college . '-' . $course->course;
                $data[$collegeMappings[$college]][] = [
                    'course' => $course->course,
                    'total' => $courseCounts[$key]->total ?? 0,
                ];
            }
        }

        $pdf = PDF::loadView('admin.student.reports-pdf', compact('data', 'startDate', 'endDate', 'schoolYear', 'semester'));

        return $pdf->stream('attendance_report.pdf');
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


    public function FacultyReports(Request $request)
    {
        // Define mappings for colleges
        $collegeMappings = [
            'CBEA' => 'College of Business, Entrepreneurship and Accountancy',
            'CCJE' => 'College of Criminal Justice Education',
            'CHM' => 'College of Hospitality Management',
            'CFAS' => 'College of Fisheries and Aquatic Science',
            'CIT' => 'College of Industrial Technology',
            'CICS' => 'College of Information and Computing Sciences',
            'CTED' => 'College of Teacher Education',
        ];

        // Get the date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch the count of faculty records grouped by college within the date range
        $collegeCounts = Faculty_and_staff::select('college', DB::raw('COUNT(faculty_records.id) as total'))
            ->leftJoin('faculty_records', function ($join) use ($startDate, $endDate) {
                $join->on('faculty_and_staffs.faculty_id', '=', 'faculty_records.faculty_id')
                    ->whereBetween('faculty_records.created_at', [$startDate, $endDate]);
            })
            ->groupBy('college')
            ->get()
            ->mapWithKeys(function ($item) use ($collegeMappings) {
                return [$collegeMappings[$item->college] => $item->total];
            });

        $pdf = PDF::loadView('admin.faculty.reports-pdf', compact('collegeCounts', 'startDate', 'endDate'));

        return $pdf->stream('faculty_attendance_report.pdf');
    }




}
