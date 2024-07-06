<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function recordCountsStudent()
    {
        $now = Carbon::now();

        // student total records
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        $dailyCount = StudentRecords::whereDate('created_at', $today)->count();
        $weeklyCount = StudentRecords::whereBetween('created_at', [$startOfWeek, Carbon::now()])->count();
        $monthlyCount = StudentRecords::whereBetween('created_at', [$startOfMonth, Carbon::now()])->count();
        $yearlyCount = StudentRecords::whereBetween('created_at', [$startOfYear, Carbon::now()])->count();




        // Daily records count
        $dailyStudentCounts = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->whereBetween('student_records.created_at', [$now->copy()->startOfDay(), $now->copy()->endOfDay()])
            ->select('student_lists.course', DB::raw('count(student_records.id) as count'))
            ->groupBy('student_lists.course')
            ->get();

        // Weekly records count
        $weeklyStudentCounts = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->whereBetween('student_records.created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])
            ->select('student_lists.course', DB::raw('count(student_records.id) as count'))
            ->groupBy('student_lists.course')
            ->get();

        // Monthly records count
        $monthlyStudentCounts = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->whereBetween('student_records.created_at', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()])
            ->select('student_lists.course', DB::raw('count(student_records.id) as count'))
            ->groupBy('student_lists.course')
            ->get();

        // Yearly records count
        $yearlyStudentCounts = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->whereBetween('student_records.created_at', [$now->copy()->startOfYear(), $now->copy()->endOfYear()])
            ->select('student_lists.course', DB::raw('count(student_records.id) as count'))
            ->groupBy('student_lists.course')
            ->get();

        // Most visited course
        $mostVisitedCourse = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->select('student_lists.course', DB::raw('count(student_records.id) as count'))
            ->groupBy('student_lists.course')
            ->orderBy('count', 'desc')
            ->first();

        // Least visited course
        $leastVisitedCourse = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->select('student_lists.course', DB::raw('count(student_records.id) as count'))
            ->groupBy('student_lists.course')
            ->orderBy('count', 'asc')
            ->first();

        return [

            'dailyCount' => $dailyCount,
            'weeklyCount' => $weeklyCount,
            'monthlyCount' => $monthlyCount,
            'yearlyCount' => $yearlyCount,
            'dailyStudentCounts' => $dailyStudentCounts,
            'weeklyStudentCounts' => $weeklyStudentCounts,
            'monthlyStudentCounts' => $monthlyStudentCounts,
            'yearlyStudentCounts' => $yearlyStudentCounts,
            'mostVisitedCourse' => $mostVisitedCourse,
            'leastVisitedCourse' => $leastVisitedCourse,
        ];
    }

    public function recordCountsFaculty()
    {
        $now = Carbon::now();

        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        // faculty total r
        $facultydailyCount = Faculty_and_staff::whereDate('created_at', $today)->count();
        $facultyweeklyCount = Faculty_and_staff::whereBetween('created_at', [$startOfWeek, Carbon::now()])->count();
        $facultymonthlyCount = Faculty_and_staff::whereBetween('created_at', [$startOfMonth, Carbon::now()])->count();
        $facultyyearlyCount = Faculty_and_staff::whereBetween('created_at', [$startOfYear, Carbon::now()])->count();

        // Daily records count
        $dailyFacultyCounts = DB::table('faculty_records')
            ->join('faculty_and_staffs', 'faculty_records.faculty_id', '=', 'faculty_and_staffs.faculty_id')
            ->whereBetween('faculty_records.created_at', [$now->copy()->startOfDay(), $now->copy()->endOfDay()])
            ->select('faculty_and_staffs.college', DB::raw('count(faculty_records.id) as count'))
            ->groupBy('faculty_and_staffs.college')
            ->get();

        // Weekly records count
        $weeklyFacultyCounts = DB::table('faculty_records')
            ->join('faculty_and_staffs', 'faculty_records.faculty_id', '=', 'faculty_and_staffs.faculty_id')
            ->whereBetween('faculty_records.created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])
            ->select('faculty_and_staffs.college', DB::raw('count(faculty_records.id) as count'))
            ->groupBy('faculty_and_staffs.college')
            ->get();

        // Monthly records count
        $monthlyFacultyCounts = DB::table('faculty_records')
            ->join('faculty_and_staffs', 'faculty_records.faculty_id', '=', 'faculty_and_staffs.faculty_id')
            ->whereBetween('faculty_records.created_at', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()])
            ->select('faculty_and_staffs.college', DB::raw('count(faculty_records.id) as count'))
            ->groupBy('faculty_and_staffs.college')
            ->get();

        // Yearly records count
        $yearlyFacultyCounts = DB::table('faculty_records')
            ->join('faculty_and_staffs', 'faculty_records.faculty_id', '=', 'faculty_and_staffs.faculty_id')
            ->whereBetween('faculty_records.created_at', [$now->copy()->startOfYear(), $now->copy()->endOfYear()])
            ->select('faculty_and_staffs.college', DB::raw('count(faculty_records.id) as count'))
            ->groupBy('faculty_and_staffs.college')
            ->get();

        // Most visited college
        $mostVisitedCollege = DB::table('faculty_records')
            ->join('faculty_and_staffs', 'faculty_records.faculty_id', '=', 'faculty_and_staffs.faculty_id')
            ->select('faculty_and_staffs.college', DB::raw('count(faculty_records.id) as count'))
            ->groupBy('faculty_and_staffs.college')
            ->orderBy('count', 'desc')
            ->first();

        // Least visited college
        $leastVisitedCollege = DB::table('faculty_records')
            ->join('faculty_and_staffs', 'faculty_records.faculty_id', '=', 'faculty_and_staffs.faculty_id')
            ->select('faculty_and_staffs.college', DB::raw('count(faculty_records.id) as count'))
            ->groupBy('faculty_and_staffs.college')
            ->orderBy('count', 'asc')
            ->first();

        return [
            'facultydailyCount' => $facultydailyCount,
            'facultyweeklyCount' => $facultyweeklyCount,
            'facultymonthlyCount' => $facultymonthlyCount,
            'facultyyearlyCount' => $facultyyearlyCount,
            'dailyFacultyCounts' => $dailyFacultyCounts,
            'weeklyFacultyCounts' => $weeklyFacultyCounts,
            'monthlyFacultyCounts' => $monthlyFacultyCounts,
            'yearlyFacultyCounts' => $yearlyFacultyCounts,
            'mostVisitedCollege' => $mostVisitedCollege,
            'leastVisitedCollege' => $leastVisitedCollege,
        ];
    }

    public function combinedDashboard()
    {
        $studentData = $this->recordCountsStudent();
        $facultyData = $this->recordCountsFaculty();

        return view('admin.dashboard', array_merge($studentData, $facultyData));
    }
}
