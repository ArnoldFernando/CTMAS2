<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;

use App\Models\College;
use App\Models\Course;
use App\Models\FacultyList;
use App\Models\FacultyRecords;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    public function StudentReports(Request $request)
    {
        // Get the date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Determine the school year and semester based on the start date
        $startMonth = (int) date('m', strtotime($startDate));
        $startYear = (int) date('Y', strtotime($startDate));
        // Initialize variables for school year and semester
        $schoolYear = '';
        $semester = '';
        if ($startMonth == 7) {
            // July is vacation period
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'Vacation';
        } elseif ($startMonth >= 8 && $startMonth <= 12) {
            // First semester
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'First Semester';
        } elseif ($startMonth >= 1 && $startMonth <= 6) {
            // Second semester
            $schoolYear = ($startYear - 1) . '-' . $startYear;
            $semester = 'Second Semester';
        }
        // Fetch college mappings from the colleges table
        $collegeMappings = College::pluck('college_name', 'college_id')->toArray();
        // Fetch all courses grouped by college for undergraduate students only
        $allCourses = StudentList::select('college_id', 'course_id')
            ->where('status', 'undergraduateschool') // Filter for undergraduate students
            ->distinct()
            ->get()
            ->groupBy('college_id');
        // Fetch the count of student records grouped by course and college within the date range
        $courseCounts = StudentList::select('student_lists.college_id', 'student_lists.course_id', DB::raw('COUNT(student_records.id) as total'))
            ->leftJoin('student_records', function ($join) use ($startDate, $endDate) {
                $join->on('student_lists.student_id', '=', 'student_records.student_id')
                    ->whereBetween('student_records.created_at', [$startDate, $endDate]);
            })
            ->where('student_lists.status', 'undergraduateschool') // Ensure we only count undergraduate students
            ->groupBy('student_lists.college_id', 'student_lists.course_id')
            ->get()
            ->keyBy(function ($item) {
                return $item->college_id . '-' . $item->course_id;
            });
        // Prepare the data for the view
        $data = [];
        foreach ($allCourses as $collegeId => $courses) {
            foreach ($courses as $course) {
                $key = $collegeId . '-' . $course->course_id;
                $data[$collegeMappings[$collegeId]][] = [
                    'course' => $course->course_id,
                    'total' => $courseCounts[$key]->total ?? 0,
                ];
            }
        }
        // Load the PDF view with the data
        $pdf = PDF::loadView('admin.student.records.reports-pdf', compact('data', 'startDate', 'endDate', 'schoolYear', 'semester'));
        return $pdf->stream('attendance_report.pdf');
    }


    public function FacultyReports(Request $request)
    {
        // Get the date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Determine the school year and semester based on the start date
        $startMonth = (int) date('m', strtotime($startDate));
        $startYear = (int) date('Y', strtotime($startDate));
       // Initialize variables for school year and semester
        $schoolYear = '';
        $semester = '';
        if ($startMonth == 7) {
            // July is vacation period
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'Vacation';
        } elseif ($startMonth >= 8 && $startMonth <= 12) {
            // First semester
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'First Semester';
        } elseif ($startMonth >= 1 && $startMonth <= 6) {
            // Second semester
            $schoolYear = ($startYear - 1) . '-' . $startYear;
            $semester = 'Second Semester';
        }
       // Fetch all colleges
        $colleges = College::pluck('college_name', 'college_id')->toArray();
        // Fetch the count of student records grouped by college within the date range
        $collegeCounts = FacultyList::select('faculty_lists.college_id', DB::raw('COUNT(faculty_records.id) as total'))
            ->leftJoin('faculty_records', function ($join) use ($startDate, $endDate) {
                $join->on('faculty_lists.faculty_id', '=', 'faculty_records.faculty_id')
                    ->whereBetween('faculty_records.created_at', [$startDate, $endDate]);
            })// Filter for undergraduate facultys
            ->groupBy('faculty_lists.college_id')
            ->get()
            ->pluck('total', 'college_id'); // Pluck college_id and total
        // Prepare the data for the view
        $data = [];
        foreach ($colleges as $collegeId => $collegeName) {
            $data[] = [
                'college' => $collegeName,
                'college_id' => $collegeId,
                'total' => $collegeCounts[$collegeId] ?? 0,
            ];
        }
        // Load the PDF view with the data
        $pdf = PDF::loadView('admin.faculty.records.reports-pdf', compact('data', 'startDate', 'endDate', 'schoolYear', 'semester'));
        return $pdf->stream('faculty_attendance_report.pdf');
    }


    public function GradschoolReports(Request $request)
    {
         // Get the date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Determine the school year and semester based on the start date
        $startMonth = (int) date('m', strtotime($startDate));
        $startYear = (int) date('Y', strtotime($startDate));
        // Initialize variables for school year and semester
        $schoolYear = '';
        $semester = '';
        if ($startMonth == 7) {
            // July is vacation period
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'Vacation';
        } elseif ($startMonth >= 8 && $startMonth <= 12) {
            // First semester
            $schoolYear = $startYear . '-' . ($startYear + 1);
            $semester = 'First Semester';
        } elseif ($startMonth >= 1 && $startMonth <= 6) {
            // Second semester
            $schoolYear = ($startYear - 1) . '-' . $startYear;
            $semester = 'Second Semester';
        }
        // Fetch all unique courses for undergraduate students
        $allCourses = StudentList::select('course_id')
            ->where('status', 'graduateschool') // Filter for undergraduate students
            ->distinct()
            ->get();
        // Fetch the count of student records grouped by course within the date range
        $courseCounts = StudentList::select('student_lists.course_id', DB::raw('COUNT(student_records.id) as total'))
            ->leftJoin('student_records', function ($join) use ($startDate, $endDate) {
                $join->on('student_lists.student_id', '=', 'student_records.student_id')
                    ->whereBetween('student_records.created_at', [$startDate, $endDate]);
            })
            ->where('student_lists.status', 'graduateschool') // Ensure we only count undergraduate students
            ->groupBy('student_lists.course_id')
            ->get()
            ->pluck('total', 'course_id'); // Pluck course_id and total
        // Prepare the data for the view
        $data = [];
        foreach ($allCourses as $course) {
            $data[] = [
                'course' => $course->course_id,
                'total' => $courseCounts[$course->course_id] ?? 0,
            ];
        }
        // Load the PDF view with the data
        $pdf = PDF::loadView('admin.graduateschool.records.reports-pdf', compact('data', 'startDate', 'endDate', 'schoolYear', 'semester'));
        return $pdf->stream('attendance_report.pdf');
    }

}
