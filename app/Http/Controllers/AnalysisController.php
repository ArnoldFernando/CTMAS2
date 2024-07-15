<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use App\Models\StudentRecords;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AnalysisController extends Controller
{
    //
    public function index(Request $request)
    {
        // Fetch unique colleges and courses
        $colleges = StudentRecords::with('student')
            ->get()
            ->pluck('student.college')
            ->unique()
            ->values();

        $courses = StudentRecords::with('student')
            ->get()
            ->pluck('student.course')
            ->unique()
            ->values();
        // Initialize variables for analysis results
        $totalAttendance = $averageTime = $dailyAttendance = $weeklyAttendance = $monthlyAttendance = $yearlyAttendance = null;
        $attendanceByCourse = $attendanceByCollege = collect();
        $topStudents = $peakCheckInTime = $peakCheckOutTime = null;

        if ($request->has('college') || $request->has('course') || $request->has('name') || $request->has('start_date') || $request->has('end_date')) {
            // Get user input
            $college = $request->input('college');
            $course = $request->input('course');
            $name = $request->input('name');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

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

            if ($startDate) {
                $studentRecordsQuery->whereDate('created_at', '>=', $startDate);
            }

            if ($endDate) {
                $studentRecordsQuery->whereDate('created_at', '<=', $endDate);
            }

            // Perform analysis based on filtered records
            $totalAttendance = $studentRecordsQuery->whereNotNull('time_in')->whereNotNull('time_out')->count();
            $averageTime = $studentRecordsQuery->select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, time_in, time_out)) as avg_time'))->first()->avg_time;
            $dailyAttendance = $studentRecordsQuery->whereDate('created_at', Carbon::today())->count();
            $weeklyAttendance = $studentRecordsQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $monthlyAttendance = $studentRecordsQuery->whereMonth('created_at', Carbon::now()->month)->count();
            $yearlyAttendance = $studentRecordsQuery->whereYear('created_at', Carbon::now()->year)->count();

            $attendanceByCourse = $studentLists->groupBy('course')->map(function ($group) {
                return $group->count();
            });

            $attendanceByCollege = $studentLists->groupBy('college')->map(function ($group) {
                return $group->count();
            });

            $topStudentsRaw = $studentRecordsQuery->select('student_id', DB::raw('COUNT(*) as attendance_count'))
                ->groupBy('student_id')
                ->get();

            $topStudents = $topStudentsRaw->map(function ($record) {
                $student = StudentRecords::where('student_id', $record->student_id)->first();
                $student->attendance_count = $record->attendance_count;
                return $student;
            })->sortByDesc('attendance_count')->take(5);

            $peakCheckInTime = $studentRecordsQuery->select(DB::raw('HOUR(time_in) as hour_in'), DB::raw('COUNT(id) as count'))
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
                'yearlyAttendance',
                'attendanceByCourse',
                'attendanceByCollege',
                'topStudents',
                'peakCheckInTime',
                'peakCheckOutTime'
            )
        );
    }

    public function export(Request $request)
    {
        $fileName = 'attendance_analysis.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('College', 'Course', 'Student Name', 'Date', 'Time In', 'Time Out');

        $callback = function () use ($request, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Get user input
            $college = $request->input('college');
            $course = $request->input('course');
            $name = $request->input('name');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

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

            if ($startDate) {
                $studentRecordsQuery->whereDate('created_at', '>=', $startDate);
            }

            if ($endDate) {
                $studentRecordsQuery->whereDate('created_at', '<=', $endDate);
            }

            $studentRecords = $studentRecordsQuery->get();

            foreach ($studentRecords as $record) {
                $student = StudentList::where('student_id', $record->student_id)->first();
                $row = array(
                    $student->college,
                    $student->course,
                    $student->name,
                    $record->created_at->format('Y-m-d'),
                    $record->time_in,
                    $record->time_out
                );

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
