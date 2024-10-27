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
    public function fetchRankedStudents() {
        $datas = StudentList::select('student_id', 'first_name', 'image') // Add 'image' or other necessary fields
                        ->get();
        return response()->json($datas);
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
            return response()->json([ 'idnotexist' => 'ID does not exist.'], 404);
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
                        return response()->json(['outStudent' => 'Cannot time in within 20 seconds of time out.'], 400);

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


        $studentData = [
            'first_name' => $student->first_name ? $student->first_name : "",
            'middle_initial' => $student->middle_initial ? $student->middle_initial : "",
            'last_name' => $student->last_name ? $student->last_name : "",
            'course_id' => $student->course_id, // Assuming 'course' is a field in StudentList
            'college_id' => $student->college_id ? $student->college_id : "", // Assuming 'department' is a field
            'image' => $student->image
            ? asset('student-images/' . $student->image)
            : asset('IMG/default.jpg'), // Path to default image
            'currentTime' => Carbon::now()->format('h:i A') // Current time formatted
        ];
        return response()->json(['studentTimein' => 'Student time in recorded successfully.', 'studentData' => $studentData]);
    }

    protected function StudentTimeOut($latestRecord, $student)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return response()->json([ 'inStudent' => 'Cannot time out within 20 seconds of time in.'], 400);

        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();
        $studentData = [
            'first_name' => $student->first_name ? $student->first_name : "",
            'middle_initial' => $student->middle_initial ? $student->middle_initial : "",
            'last_name' => $student->last_name ? $student->last_name : "",
            'course_id' => $student->course_id, // Assuming 'course' is a field in StudentList
            'college_id' => $student->college_id ? $student->college_id : "", // Assuming 'department' is a field
            'image' => $student->image
            ? asset('student-images/' . $student->image)
            : asset('IMG/default.jpg'), // Path to default image
            'currentTime' => Carbon::now()->format('h:i A')
        ];

        return response()->json(['studentTimeout' => 'Student time out recorded successfully.', 'studentData' => $studentData]);
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
                        return response()->json(['outFaculty' => 'Cannot time in within 20 seconds of time out.'], 400);
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

        $facultyData = [
            'first_name' => $faculty->first_name ? $faculty->first_name :  "",
            'middle_initial' => $faculty->middle_initial ? $faculty->middle_initial: "",
            'last_name' => $faculty->last_name ? $faculty->last_name : "",
            'course_id' => $faculty->course_id, // Assuming 'course' is a field in facultyList
            'college_id' => $faculty->college_id, // Assuming 'department' is a field
            'image' => $faculty->image
                ? asset('faculty-images/' . $faculty->image)
                : asset('IMG/default.jpg'), // Path to default image
            'currentTime' => Carbon::now()->format('h:i A') // Current time formatted
        ];

        return response()->json(['facultyTimein' => 'Faculty time in recorded successfully.', 'facultyData' => $facultyData]);
    }

    protected function facultyTimeOut($latestRecord, $faculty)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return response()->json([ 'inFaculty' => 'Cannot time out within 20 seconds of time in.'], 400);
        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();

        $facultyData = [
            'first_name' => $faculty->first_name ? $faculty->first_name :  "",
            'middle_initial' => $faculty->middle_initial ? $faculty->middle_initial: "",
            'last_name' => $faculty->last_name ? $faculty->last_name : "",
            'course_id' => $faculty->course_id, // Assuming 'course' is a field in facultyList
            'college_id' => $faculty->college_id, // Assuming 'department' is a field
            'image' => $faculty->image
                ? asset('faculty-images/' . $faculty->image)
                : asset('IMG/default.jpg'), // Path to default image
            'currentTime' => Carbon::now()->format('h:i A') // Current time formatted
        ];

        return response()->json(['facultyTimeout' => 'Faculty time in recorded successfully.', 'facultyData' => $facultyData]);
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



//     protected function getSessionData()
// {
//     $sessionTypes = ['student', 'faculty'];
//     $sessionData = [];

//     foreach ($sessionTypes as $type) {
//         if (session($type)) {
//             $data = session($type);
//             $sessionData[] = [
//                 'image' => $data->image ? asset("$type-images/{$data->image}") : asset('IMG/default.jpg'),
//                 'first_name' => $data->first_name,
//                 'middle_initial' => $data->middle_initial,
//                 'last_name' => $data->last_name,
//                 'course_id' => in_array($type, ['student']) ? $data->course_id : 'N/A',
//                 'college_id' => in_array($type, ['student', 'faculty']) ? $data->college_id : 'N/A',
//                 'currentTime' => session('currentTime')
//             ];
//         }
//     }

//     return response()->json($sessionData);
// }

}
