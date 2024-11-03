<?php

namespace App\Http\Controllers;

use App\Models\StudentRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function course(Request $request)
    {
        $monthlyCourseVisits = DB::table('student_records')
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->select(DB::raw('MONTH(student_records.created_at) as month'), 'student_lists.course_id', DB::raw('COUNT(student_records.id) as visits'))
        ->groupBy('month', 'student_lists.course_id')
        ->orderBy('month')
        ->get();

    // Month names instead of numbers
    $monthNames = [
        'January', 'February', 'March', 'April',
        'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December'
    ];


    $courses = $monthlyCourseVisits->pluck('course_id')->unique()->toArray();

    $data = [];

// Initialize data structure with month names as keys
foreach ($courses as $course) {
    $data[$course] = array_fill_keys($monthNames, 0); // Fill with 0 for each month name
}

// Populate data with visit counts
foreach ($monthlyCourseVisits as $visit) {
    $data[$visit->course_id][$monthNames[$visit->month - 1]] = $visit->visits; // Using month name as key
}

    return response()->json([
        'labels' => array_values($monthNames), // Use month names as labels
        'data' => $data
    ]);
    }


    public function college(Request $request)
    {
        $monthlycollegeVisits = DB::table('student_records')
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->select(DB::raw('MONTH(student_records.created_at) as month'), 'student_lists.college_id', DB::raw('COUNT(student_records.id) as visits'))
        ->groupBy('month', 'student_lists.college_id')
        ->orderBy('month')
        ->get();

    // Month names instead of numbers
    $monthNames = [
        'January', 'February', 'March', 'April',
        'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December'
    ];


    $colleges = $monthlycollegeVisits->pluck('college_id')->unique()->toArray();

    $data = [];

// Initialize data structure with month names as keys
foreach ($colleges as $college) {
    $data[$college] = array_fill_keys($monthNames, 0); // Fill with 0 for each month name
}

// Populate data with visit counts
foreach ($monthlycollegeVisits as $visit) {
    $data[$visit->college_id][$monthNames[$visit->month - 1]] = $visit->visits; // Using month name as key
}

    return response()->json([
        'labels' => array_values($monthNames), // Use month names as labels
        'data' => $data
    ]);
    }
}
