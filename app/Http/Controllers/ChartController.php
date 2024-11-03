<?php

namespace App\Http\Controllers;

use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function monthlycourse(Request $request)
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


    public function monthlycollege(Request $request)
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








    public function weeklycourse(Request $request)
    {
        $month = $request->input('month', date('m')); // Default to current month if not provided
        $year = date('Y'); // Optional: you can extend this to allow selection of different years

        $weeklyCourseVisits = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->select(
                DB::raw('WEEK(student_records.created_at, 1) as week'), // Week number
                'student_lists.course_id',
                DB::raw('COUNT(student_records.id) as visits')
            )
            ->whereMonth('student_records.created_at', $month)
            ->whereYear('student_records.created_at', $year)
            ->groupBy('week', 'student_lists.course_id')
            ->orderBy('week')
            ->get();

        $courses = $weeklyCourseVisits->pluck('course_id')->unique()->toArray();

        $data = [];
        $labels = [];

        // Create labels for each week
        foreach ($weeklyCourseVisits->pluck('week')->unique()->sort() as $week) {
            $labels[] = 'Week ' . $week;
        }

        // Initialize data structure with weeks as keys
        foreach ($courses as $course) {
            $data[$course] = array_fill_keys($labels, 0); // Fill with 0 for each week
        }

        // Populate data with visit counts per week
        foreach ($weeklyCourseVisits as $visit) {
            $weekLabel = 'Week ' . $visit->week;
            $data[$visit->course_id][$weekLabel] = $visit->visits;
        }

        return response()->json([
            'labels' => $labels, // Use week labels
            'data' => $data
        ]);
    }


    public function weeklycollege(Request $request)
    {
        $month = $request->input('month', date('m')); // Default to current month if not provided
        $year = date('Y'); // Optional: you can extend this to allow selection of different years

        $weeklycollegeVisits = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->select(
                DB::raw('WEEK(student_records.created_at, 1) as week'), // Week number
                'student_lists.college_id',
                DB::raw('COUNT(student_records.id) as visits')
            )
            ->whereMonth('student_records.created_at', $month)
            ->whereYear('student_records.created_at', $year)
            ->groupBy('week', 'student_lists.college_id')
            ->orderBy('week')
            ->get();

        $colleges = $weeklycollegeVisits->pluck('college_id')->unique()->toArray();

        $data = [];
        $labels = [];

        // Create labels for each week
        foreach ($weeklycollegeVisits->pluck('week')->unique()->sort() as $week) {
            $labels[] = 'Week ' . $week;
        }

        // Initialize data structure with weeks as keys
        foreach ($colleges as $college) {
            $data[$college] = array_fill_keys($labels, 0); // Fill with 0 for each week
        }

        // Populate data with visit counts per week
        foreach ($weeklycollegeVisits as $visit) {
            $weekLabel = 'Week ' . $visit->week;
            $data[$visit->college_id][$weekLabel] = $visit->visits;
        }

        return response()->json([
            'labels' => $labels, // Use week labels
            'data' => $data
        ]);
    }


}




