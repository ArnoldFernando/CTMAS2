<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\StudentList;
use Illuminate\Http\Request;
use App\Models\FacultyRecords;
use App\Models\StudentRecords;
use App\Models\Faculty_and_staff;
use Illuminate\Support\Facades\Log;

class SessionController extends Controller
{
    public function startSessionPage()
    {
        return view('admin.student.session.start-session');
    }


    public function handleTime(Request $request)
    {
        $id = $request->input('id');

        // Log the input ID for debugging
        Log::info('Input ID: ' . $id);

        // Check if the ID exists in the student or faculty table
        $student = StudentList::where('student_id', $id)->first();
        $faculty = Faculty_and_staff::where('faculty_id', $id)->first();

        if ($student) {
            return $this->handleStudentTime($id, $student);
        } elseif ($faculty) {
            return $this->handleFacultyTime($id, $faculty);
        } else {
            return redirect()->back()->with('idnotexist', 'ID does not exist.');
        }
    }


    // handle student time
    protected function handleStudentTime($studentId, $student)
    {
        $latestRecord = StudentRecords::where('student_id', $studentId)->whereNull('time_out')->first();

        if ($latestRecord) {
            return $this->timeOut($latestRecord, $student);
        } else {
            return $this->timeIn($studentId, $student);
        }
    }


    protected function timeIn($studentId, $student)
    {
        $record = new StudentRecords();
        $record->student_id = $studentId;
        $record->time_in = Carbon::now()->toTimeString();
        $record->save();

        return redirect()->back()->with('timein', 'Student time in recorded successfully.')
            ->with('student', $student)
            ->with('currentTime', Carbon::now()->format('H:i:s'));
    }

    // protected function timeOut($latestRecord, $student)
    // {
    //     $latestRecord->time_out = Carbon::now()->toTimeString();
    //     $latestRecord->save();

    //     return redirect()->back()->with('message', 'Student time out recorded successfully.')
    //         ->with('student', $student);
    // }

    protected function timeOut($latestRecord, $student)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return redirect()->back()->with('20second', 'Cannot time out within 20 seconds of time in.')
                ->with('student', $student)
                ->with('currentTime', Carbon::now()->format('H:i:s'));
        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();

        return redirect()->back()->with('studentTimeout', 'Student time out recorded successfully.')
            ->with('student', $student)
            ->with('currentTime', Carbon::now()->format('H:i:s'));
    }

    // HANDLE FACULTY TIMEOUT
    protected function handleFacultyTime($facultyId, $faculty)
    {
        $latestRecord = FacultyRecords::where('faculty_id', $facultyId)->whereNull('time_out')->first();

        if ($latestRecord) {
            return $this->facultyTimeOut($latestRecord, $faculty);
        } else {
            return $this->facultyTimeIn($facultyId, $faculty);
        }
    }

    protected function facultyTimeIn($facultyId, $faculty)
    {
        $record = new FacultyRecords();
        $record->faculty_id = $facultyId;
        $record->time_in = Carbon::now()->toTimeString();
        $record->save();

        return redirect()->back()->with('facultytimein', 'Faculty time in recorded successfully.')
            ->with('faculty', $faculty)
            ->with('currentTime', Carbon::now()->format('H:i:s'));
    }

    protected function facultyTimeOut($latestRecord, $faculty)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return redirect()->back()->with('20second', 'Cannot time out within 20 seconds of time in.')
                ->with('faculty', $faculty)
                ->with('currentTime', Carbon::now()->format('H:i:s'));
        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();

        return redirect()->back()->with('facultytimeout', 'Faculty time out recorded successfully.')
            ->with('faculty', $faculty)
            ->with('currentTime', Carbon::now()->format('H:i:s'));
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
