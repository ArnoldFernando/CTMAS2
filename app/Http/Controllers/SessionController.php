<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function startSessionPage()
    {
        return view('admin.student.session.start-session');

    }

    public function handleTime(Request $request)
    {
        $studentId = $request->input('student_id');

        // Check if the student ID exists in the student_lists table
        $student = StudentList::where('student_id', $studentId)->first();

        if (!$student) {
            return redirect()->back()->with('message', 'Student ID does not exist.');
        }

        // Check the latest record for the student with a null time_out
        $latestRecord = StudentRecords::where('student_id', $studentId)->whereNull('time_out')->first();

        if ($latestRecord) {
            // If there's an ongoing session (time_out is null), record time out
            return $this->timeOut($latestRecord, $student);
        } else {
            // Otherwise, start a new session and record time in
            return $this->timeIn($studentId, $student);
        }
    }

    protected function timeIn($studentId, $student)
    {
        $record = new StudentRecords();
        $record->student_id = $studentId;
        $record->time_in = Carbon::now()->toTimeString();
        $record->save();

        return redirect()->back()->with('message', 'Time in recorded successfully.')
            ->with('student', $student);
    }

    protected function timeOut($latestRecord, $student)
    {
        $latestRecord->time_out = Carbon::now()->toTimeString();
        $latestRecord->save();

        return redirect()->back()->with('message', 'Time out recorded successfully.')
            ->with('student', $student);
    }

    public function ShowAllSession()
    {
        $todayDate = now()->timezone('Asia/Manila')->toDateString();

        // Get all active sessions (records with null time_out) with student data
        $activeSessions = StudentRecords::whereNull('time_out')->with('student')->get();

        // Get all sessions that have a time_in today with student data
        $studentsTimedInToday = StudentRecords::whereDate('created_at', $todayDate)
            ->with('student')
            ->get();

        foreach ($studentsTimedInToday as $studentRecord) {
            if ($studentRecord->time_out) {
                $timeIn = Carbon::parse($studentRecord->time_in);
                $timeOut = Carbon::parse($studentRecord->time_out);
                $duration = $timeIn->diff($timeOut)->format('%H:%I:%S');
                $studentRecord->duration = $duration;
            } else {
                $studentRecord->duration = null;
            }
        }

        $allSessions = StudentRecords::with('student')->get();
        $sessionsByDay = $allSessions->groupBy(function ($session) {
            return $session->created_at->format('Y-m-d');
        });

        return view('admin.student.session.all-student-records', [
            'activeSessions' => $activeSessions,
            'studentsTimedInToday' => $studentsTimedInToday,
            'sessionsByDay' => $sessionsByDay,
        ]);
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

        return view('admin.student.session.active-session', [
            'studentsTimedInToday' => $studentsTimedInToday,
        ]);
    }

}
