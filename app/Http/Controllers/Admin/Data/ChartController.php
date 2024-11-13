<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function monthlycourse(Request $request)
    {
        $year = $request->query('year', date('Y'));

        $monthlyCourseVisits = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->whereYear('student_records.created_at', $year)
            ->select(DB::raw('MONTH(student_records.created_at) as month'), 'student_lists.course_id', DB::raw('COUNT(student_records.id) as visits'))
            ->groupBy('month', 'student_lists.course_id')
            ->orderBy('month')
            ->get();

        $monthNames = [
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December'
        ];

        $courses = $monthlyCourseVisits->pluck('course_id')->unique()->toArray();
        $data = [];

        foreach ($courses as $course) {
            $data[$course] = array_fill_keys($monthNames, 0);
        }

        foreach ($monthlyCourseVisits as $visit) {
            $data[$visit->course_id][$monthNames[$visit->month - 1]] = $visit->visits;
        }

        return response()->json([
            'labels' => $monthNames,
            'data' => $data
        ]);
    }


    public function monthlycollege(Request $request)
{
    $year = $request->query('year', date('Y'));

    $monthlycollegeVisits = DB::table('student_records')
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->whereYear('student_records.created_at', $year)
        ->select(DB::raw('MONTH(student_records.created_at) as month'), 'student_lists.college_id', DB::raw('COUNT(student_records.id) as visits'))
        ->groupBy('month', 'student_lists.college_id')
        ->orderBy('month')
        ->get();

    $monthNames = [
        'January', 'February', 'March', 'April',
        'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December'
    ];

    $colleges = $monthlycollegeVisits->pluck('college_id')->unique()->toArray();
    $data = [];

    foreach ($colleges as $college) {
        $data[$college] = array_fill_keys($monthNames, 0);
    }

    foreach ($monthlycollegeVisits as $visit) {
        $data[$visit->college_id][$monthNames[$visit->month - 1]] = $visit->visits;
    }

    return response()->json([
        'labels' => $monthNames,
        'data' => $data
    ]);
}






    public function weeklycourse(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Fetch the minimum and maximum years with data in your database
        $minYear = DB::table('student_records')->min(DB::raw('YEAR(created_at)'));
        $maxYear = DB::table('student_records')->max(DB::raw('YEAR(created_at)'));

        // Your existing query to fetch weekly course visits data
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

        // Prepare the data for the chart
        if ($weeklyCourseVisits->isEmpty()) {
            return response()->json([
                'message' => 'No data available for the selected year or the previous year.',
                'data' => [],
                'labels' => [],
                'minYear' => $minYear,
                'maxYear' => $maxYear
            ]);
        }

        // Construct the response with labels and data
        $courses = $weeklyCourseVisits->pluck('course_id')->unique()->toArray();
        $data = [];
        $labels = [];

        foreach ($weeklyCourseVisits->pluck('week')->unique()->sort() as $week) {
            $labels[] = 'Week ' . $week;
        }

        foreach ($courses as $course) {
            $data[$course] = array_fill_keys($labels, 0); // Fill with 0 for each week
        }

        foreach ($weeklyCourseVisits as $visit) {
            $weekLabel = 'Week ' . $visit->week;
            $data[$visit->course_id][$weekLabel] = $visit->visits;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'minYear' => $minYear,
            'maxYear' => $maxYear
        ]);
    }

    public function weeklycollege(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Fetch the minimum and maximum years with data in your database
        $minYear = DB::table('student_records')->min(DB::raw('YEAR(created_at)'));
        $maxYear = DB::table('student_records')->max(DB::raw('YEAR(created_at)'));

        // Your existing query to fetch weekly college visits data
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

        // Prepare the data for the chart
        if ($weeklycollegeVisits->isEmpty()) {
            return response()->json([
                'message' => 'No data available for the selected year or the previous year.',
                'data' => [],
                'labels' => [],
                'minYear' => $minYear,
                'maxYear' => $maxYear
            ]);
        }

        // Construct the response with labels and data
        $colleges = $weeklycollegeVisits->pluck('college_id')->unique()->toArray();
        $data = [];
        $labels = [];

        foreach ($weeklycollegeVisits->pluck('week')->unique()->sort() as $week) {
            $labels[] = 'Week ' . $week;
        }

        foreach ($colleges as $college) {
            $data[$college] = array_fill_keys($labels, 0); // Fill with 0 for each week
        }

        foreach ($weeklycollegeVisits as $visit) {
            $weekLabel = 'Week ' . $visit->week;
            $data[$visit->college_id][$weekLabel] = $visit->visits;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'minYear' => $minYear,
            'maxYear' => $maxYear
        ]);
    }



}




