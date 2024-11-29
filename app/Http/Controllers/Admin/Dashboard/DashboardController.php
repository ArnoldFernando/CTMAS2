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

//     public function index()
// {
//     $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();
//     $today = Carbon::now()->endOfDay();

//     // Daily Time-In Count for Today
//     $dailyCount = StudentRecords::whereDate('created_at', '=', Carbon::now()->toDateString())
//         ->whereNotNull('time_in')
//         ->whereNotNull('time_out')
//         ->count();

//     // Weekly Total Duration for the Latest 7 Days
//     $weeklyTotalTime = StudentRecords::whereBetween('created_at', [$sevenDaysAgo, $today])
//         ->whereNotNull('time_in')
//         ->whereNotNull('time_out')
//         ->get()
//         ->reduce(function ($carry, $record) {
//             $timeIn = Carbon::parse($record->time_in);
//             $timeOut = Carbon::parse($record->time_out);
//             $duration = $timeOut->diffInMinutes($timeIn);
//             return $carry + $duration;
//         }, 0);

//     // Weekly Average Time
//     $weeklyAverage = $weeklyTotalTime > 0 ? round($weeklyTotalTime / (7 * 60), 2) : 0;

//    // Monthly Time-In Count
// $startOfMonth = Carbon::now()->startOfMonth();
// $endOfMonth = Carbon::now()->endOfMonth();

// $monthlyTimeInCount = StudentRecords::whereBetween('created_at', [$startOfMonth, $endOfMonth])
//     ->whereNotNull('time_in')
//     ->count();

//     // Count Courses Tracked
//     $courseCount = DB::table('student_lists')
//         ->distinct('course_id')
//         ->count('course_id');

//     // Fetch daily duration data joined with course information for the latest 7 days
//     $timeInData = StudentRecords::select('student_records.student_id', 'student_records.time_in', 'student_records.time_out', 'student_lists.course_id', 'student_records.created_at')
//     ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
//     ->whereBetween('student_records.created_at', [$sevenDaysAgo, $today])
//     ->whereNotNull('student_records.time_in')
//     ->whereNotNull('student_records.time_out')  // Ensuring that time_out is not null
//     ->get()
//     ->groupBy(function ($record) {
//         return $record->course_id . '|' . Carbon::parse($record->created_at)->format('Y-m-d');
//     });


//      // Get records for the last 7 days
//      // Generate the last 7 days including today
//     // Generate the last 7 days including today
//     $last7Days = collect();
//     for ($i = 6; $i >= 0; $i--) {
//         $last7Days->push(Carbon::today()->subDays($i)->toDateString());
//     }

//     // Fetch records from the database for the last 7 days
//     $records = DB::table('student_records')
//         ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
//         ->join('courses', 'student_lists.course_id', '=', 'courses.course_id')
//         ->selectRaw('
//             DATE(student_records.created_at) as date,  -- Ensure we are comparing only dates
//             courses.course_name as course,
//             student_records.time_in,
//             student_records.time_out
//         ')
//         ->whereNotNull('student_records.time_out')
//         ->whereBetween('student_records.created_at', [
//             Carbon::now()->subDays(6)->startOfDay(),
//             Carbon::now()->endOfDay()
//         ])  // Ensure we fetch records for the last 7 days
//         ->get();

//     // Group records by date and course, and calculate average durations
//     $groupedRecords = $records->groupBy(['date', 'course'])->map(function ($dayCourses) {
//         return $dayCourses->map(function ($records) {
//             // Calculate total duration in minutes for each course
//             $totalMinutes = $records->reduce(function ($carry, $record) {
//                 $timeIn = Carbon::parse($record->time_in);
//                 $timeOut = Carbon::parse($record->time_out);
//                 return $carry + $timeIn->diffInMinutes($timeOut);
//             }, 0);

//             // Return average duration for the day
//             return $totalMinutes / max(1, $records->count());
//         });
//     });

//     return view('admin.dashboard', compact('dailyCount', 'weeklyAverage', 'monthlyTimeInCount', 'courseCount',));
// }


public function index()
{
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    // Fetch daily, weekly, and monthly data
    $dailyCount = StudentRecords::whereDate('created_at', '=', Carbon::now()->toDateString())
        ->whereNotNull('time_in')->count();

    $weeklyTotalTime = StudentRecords::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->whereNotNull('time_in')->whereNotNull('time_out')
        ->get()->reduce(function ($carry, $record) {
            $carry += Carbon::parse($record->time_out)->diffInMinutes(Carbon::parse($record->time_in));
            return $carry;
        }, 0);
    $weeklyAverage = $weeklyTotalTime > 0 ? round($weeklyTotalTime / 5, 2) : 0;

    $monthlyTotal = StudentRecords::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->whereNotNull('time_in')->count();

    $courseCount = DB::table('student_lists')->distinct('course_id')->count('course_id');

    // Average time per course for the current month
    $averageTimePerCourse = StudentRecords::select('student_lists.course_id', DB::raw('AVG(TIMESTAMPDIFF(MINUTE, time_in, time_out)) as avg_time'))
        ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
        ->whereBetween('student_records.created_at', [$startOfMonth, $endOfMonth])
        ->whereNotNull('time_in')
        ->whereNotNull('time_out')
        ->groupBy('student_lists.course_id')
        ->pluck('avg_time', 'student_lists.course_id');

    return view('admin.dashboard', compact('dailyCount', 'weeklyAverage', 'monthlyTotal', 'courseCount', 'averageTimePerCourse'));
}



}
