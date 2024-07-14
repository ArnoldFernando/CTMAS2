<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use App\Models\StudentRecords;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    //
    public function index(Request $request)
    {
        // Fetch unique colleges and courses
        $colleges = StudentList::select('college')->distinct()->get();
        $courses = StudentList::select('course')->distinct()->get();

        // Initialize variables for analysis results
        $totalAttendance = $averageTime = $dailyAttendance = $weeklyAttendance = $monthlyAttendance = null;
        $attendanceByCourse = $attendanceByCollege = collect();
        $peakCheckInTime = $peakCheckOutTime = null;

        if ($request->has('college') || $request->has('course') || $request->has('name')) {
            // Get user input
            $college = $request->input('college');
            $course = $request->input('course');
            $name = $request->input('name');

            // Build the query with conditional filters
            $studentRecordsQuery = StudentRecords::query();
            $studentListsQuery = StudentList::query();

            if ($college) {
                $studentListsQuery->where('college', $college);
            }

            if ($course) {
                $studentListsQuery->where('course', $course);
            }

            if ($name) {
                $studentListsQuery->where('name', 'LIKE', "%{$name}%");
            }

            // Join student lists with records
            $studentLists = $studentListsQuery->get();
            $studentIds = $studentLists->pluck('student_id');

            if ($studentIds->isNotEmpty()) {
                $studentRecordsQuery->whereIn('student_id', $studentIds);
            }

            // Perform analysis based on filtered records
            $totalAttendance = $studentRecordsQuery->whereNotNull('time_in')->whereNotNull('time_out')->count();
            $averageTime = $studentRecordsQuery->select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, time_in, time_out)) as avg_time'))->first()->avg_time;
            $dailyAttendance = $studentRecordsQuery->whereDate('created_at', Carbon::today())->count();
            $weeklyAttendance = $studentRecordsQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $monthlyAttendance = $studentRecordsQuery->whereMonth('created_at', Carbon::now()->month)->count();

            $attendanceByCourse = $studentLists->groupBy('course')->map(function ($group) {
                return $group->count();
            });

            $attendanceByCollege = $studentLists->groupBy('college')->map(function ($group) {
                return $group->count();
            });

            $peakCheckInTime = $studentRecordsQuery->select(DB::raw('time_in'), DB::raw('COUNT(id) as count'))
                ->groupBy('time_in')
                ->orderBy('count', 'desc')
                ->first();

            $peakCheckOutTime = $studentRecordsQuery->select(DB::raw('HOUR(time_out) as hour_out'), DB::raw('COUNT(id) as count'))
                ->groupBy('hour_out')
                ->orderBy('count', 'desc')
                ->first();
        }

        return view(
            'admin.analysis',
            compact(
                'colleges',
                'courses',
                'totalAttendance',
                'averageTime',
                'dailyAttendance',
                'weeklyAttendance',
                'monthlyAttendance',
                'attendanceByCourse',
                'attendanceByCollege',
                'peakCheckInTime',
                'peakCheckOutTime'
            )
        );
    }
}
