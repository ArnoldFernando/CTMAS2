<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\StudentList;
use Illuminate\Http\Request;
use App\Models\FacultyRecords;
use App\Models\StudentRecords;
use App\Models\FacultyList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SessionController extends Controller
{
    public function startSessionPage()
    {
        $rankedStudents = DB::table('student_records')
            ->join('student_lists', 'student_records.student_id', '=', 'student_lists.student_id')
            ->select('student_lists.student_id', 'student_lists.first_name', 'student_lists.course_id', DB::raw('COUNT(student_records.id) as total_records'))
            ->groupBy('student_lists.student_id', 'student_lists.first_name', 'student_lists.course_id')
            ->orderByDesc('total_records')
            ->take(10)
            ->get();
        return view('admin..session.start-session', compact('rankedStudents'));
    }

    public function handleTime(Request $request)
    {
        $id = $request->input('id');

        // Log the input ID for debugging
        Log::info('Input ID: ' . $id);

        // Check if the ID exists in the student or faculty table
        $student = StudentList::where('student_id', $id)->first();
        $faculty = FacultyList::where('faculty_id', $id)->first();

        if ($student) {
            return $this->handleStudentTime($id, $student);
        } elseif ($faculty) {
            return $this->handleFacultyTime($id, $faculty);
        } else {
            return redirect()->back()->with('idnotexist', 'ID does not exist.');
        }
    }

    // Handle student time
    protected function handleStudentTime($studentId, $student)
    {
        $latestRecord = StudentRecords::where('student_id', $studentId)->latest()->first();

        if ($latestRecord) {
            $recordDate = Carbon::parse($latestRecord->created_at)->toDateString();
            $currentDate = Carbon::now()->toDateString();

            if ($recordDate === $currentDate) {
                // If the latest record is from today, check if time_out is null
                if ($latestRecord->time_out === null) {
                    return $this->StudentTimeOut($latestRecord, $student);
                } else {
                    $timeOut = Carbon::parse($latestRecord->time_out);
                    $currentTime = Carbon::now();
                    $diffInSeconds = $currentTime->diffInSeconds($timeOut);

                    if ($diffInSeconds < 20) {
                        return redirect()->back()->with('20seconds-out-student', 'Cannot time in within 20 seconds of time out.')
                            ->with('student', $student)
                            ->with('currentTime', Carbon::now()->format('h:i A'));
                    }
                }
            } else {
                // If the latest record is from a previous day, create a new time in record
                return $this->StudentTimeIn($studentId, $student);
            }
        } else {
            // If no record exists, create a new time in record
            return $this->StudentTimeIn($studentId, $student);
        }

        // Default to creating a new time in record
        return $this->StudentTimeIn($studentId, $student);
    }

    protected function StudentTimeIn($studentId, $student)
    {
        $record = new StudentRecords();
        $record->student_id = $studentId;
        $record->time_in = Carbon::now()->toTimeString();
        $record->save();

        return redirect()->back()->with('studentTimein', 'Student time in recorded successfully.')
            ->with('student', $student)
            ->with('currentTime', Carbon::now()->format('h:i A'));
    }

    protected function StudentTimeOut($latestRecord, $student)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return redirect()->back()->with('20seconds-in-student', 'Cannot time out within 20 seconds of time in.')
                ->with('student', $student)
                ->with('currentTime', Carbon::now()->format('h:i A'));
        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();

        return redirect()->back()->with('studentTimeout', 'Student time out recorded successfully.')
            ->with('student', $student)
            ->with('currentTime', Carbon::now()->format('h:i A'));
    }

    // Handle faculty time
    protected function handleFacultyTime($facultyId, $faculty)
    {
        $latestRecord = FacultyRecords::where('faculty_id', $facultyId)->latest()->first();

        if ($latestRecord) {
            $recordDate = Carbon::parse($latestRecord->created_at)->toDateString();
            $currentDate = Carbon::now()->toDateString();

            if ($recordDate === $currentDate) {
                // If the latest record is from today, check if time_out is null
                if ($latestRecord->time_out === null) {
                    return $this->facultyTimeOut($latestRecord, $faculty);
                } else {
                    $timeOut = Carbon::parse($latestRecord->time_out);
                    $currentTime = Carbon::now();
                    $diffInSeconds = $currentTime->diffInSeconds($timeOut);

                    if ($diffInSeconds < 20) {
                        return redirect()->back()->with('20seconds-out-faculty', 'Cannot time in within 20 seconds of time out.')
                            ->with('faculty', $faculty)
                            ->with('currentTime', Carbon::now()->format('h:i A'));
                    }
                }
            } else {
                // If the latest record is from a previous day, create a new time in record
                return $this->facultyTimeIn($facultyId, $faculty);
            }
        } else {
            // If no record exists, create a new time in record
            return $this->facultyTimeIn($facultyId, $faculty);
        }

        // Default to creating a new time in record
        return $this->facultyTimeIn($facultyId, $faculty);
    }

    protected function facultyTimeIn($facultyId, $faculty)
    {
        $record = new FacultyRecords();
        $record->faculty_id = $facultyId;
        $record->time_in = Carbon::now()->toTimeString();
        $record->save();

        return redirect()->back()->with('facultyTimein', 'Faculty time in recorded successfully.')
            ->with('faculty', $faculty)
            ->with('currentTime', Carbon::now()->format('h:i A'));
    }

    protected function facultyTimeOut($latestRecord, $faculty)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return redirect()->back()->with('20seconds-in-faculty', 'Cannot time out within 20 seconds of time in.')
                ->with('faculty', $faculty)
                ->with('currentTime', Carbon::now()->format('h:i A'));
        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();

        return redirect()->back()->with('facultyTimeout', 'Faculty time out recorded successfully.')
            ->with('faculty', $faculty)
            ->with('currentTime', Carbon::now()->format('h:i A'));
    }






    public function showTodayTimeIns()
    {
        $todayDate = now()->timezone('Asia/Manila')->toDateString();

        // Get all students who timed in today
        $studentsTimedInToday = StudentRecords::whereDate('created_at', $todayDate)
            ->whereNotNull('time_in')
            ->with('student') // Assuming 'student' is the relationship method in StudentRecord model
            ->get();

        foreach ($studentsTimedInToday as $student) {
            $timeIn = Carbon::parse($student->time_in);
            $timeOut = Carbon::parse($student->time_out);
            $student->duration = $timeOut ? $timeOut->diff($timeIn)->format('%H:%I:%S') : 'N/A';
        }

        return view('admin.session.active-session', [
            'studentsTimedInToday' => $studentsTimedInToday,
        ]);
    }



    // ranking of most visitors students in library

}
