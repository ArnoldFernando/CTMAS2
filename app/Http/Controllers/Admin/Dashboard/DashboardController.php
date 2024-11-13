<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Faculty_and_staff;
use App\Models\FacultyList;
use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index1() {
        return view ('admin.dashboard');
    }


    public function index()
    {
        $startOfMonth = Carbon::now()->startOfWeek();
        $endOfMonth = Carbon::now()->endOfWeek()->subDays(2); // Exclude Saturday and Sunday


    // $startOfMonth = Carbon::createFromDate(null, 10, 1); // October 1st
    // $endOfMonth = Carbon::createFromDate(null, 10, 8);  // October 31st

    // Calculate Daily Time-In Count for October (e.g., last day)
    $dailyCount = StudentRecords::whereDate('created_at', '=', Carbon::now()->toDateString())
        ->whereNotNull('time_in')
        ->count();

    // Calculate Weekly Average Time-In (Monday to Friday)
    $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
    $endOfWeek = Carbon::now()->endOfWeek(Carbon::FRIDAY);
    $weeklyTotalTime = StudentRecords::whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->whereNotNull('time_in')
        ->get()
        ->reduce(function ($carry, $record) {
            $timeIn = Carbon::parse($record->time_in);
            $carry += $timeIn->hour * 60 + $timeIn->minute;
            return $carry;
        }, 0);

    $weeklyAverage = $weeklyTotalTime > 0 ? round($weeklyTotalTime / (5 * 60), 2) : 0;

    // Calculate Monthly Total Time-In for October
    $monthlyTotal = StudentRecords::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->whereNotNull('time_in')
        ->count();

    // Count Courses Tracked
    $courseCount = DB::table('student_lists')
        ->distinct('course_id')
        ->count('course_id');

    // Fetch daily time-in data joined with course information for October
    $timeInData = StudentRecords::select('student_records.student_id', 'student_records.time_in', 'student_lists.course_id', 'student_records.created_at')
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->whereBetween('student_records.created_at', [$startOfMonth, $endOfMonth])
        ->whereNotNull('student_records.time_in')
        ->get()
        ->groupBy(function($record) {
            return $record->course_id . '|' . Carbon::parse($record->created_at)->format('Y-m-d');
        });

    // Process data for Chart.js
    $chartData = [];
    foreach ($timeInData as $key => $records) {
        [$course, $date] = explode('|', $key);

        // Calculate the average time-in per day for each course
        $totalMinutes = 0;
        foreach ($records as $record) {
            $timeIn = Carbon::parse($record->time_in);
            $totalMinutes += $timeIn->hour * 60 + $timeIn->minute;
        }
        $averageMinutes = $totalMinutes / $records->count();

        // Convert minutes to hours and minutes format
        $hours = floor($averageMinutes / 60);
        $minutes = $averageMinutes % 60;

        $chartData[$course][] = [
            'date' => $date,
            'average_time' => sprintf('%02d:%02d', $hours, $minutes)
        ];
    }



    return view('admin.dashboard', compact('dailyCount', 'weeklyAverage', 'monthlyTotal', 'courseCount', 'chartData'));
    }


}
