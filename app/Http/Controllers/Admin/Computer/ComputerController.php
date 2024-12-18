<?php

namespace App\Http\Controllers\Admin\Computer;

use App\Http\Controllers\Controller;
use App\Models\ComputerRecords;
use App\Models\Faculty_and_staff;
use App\Models\FacultyList;
use App\Models\GraduateSchoolList;
use App\Models\StudentList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComputerController extends Controller
{
    public function computerPage()
    {
        $rankedStudents = DB::table('computer_records')
            ->join('student_lists', 'computer_records.student_id', '=', 'student_lists.student_id')
            ->select('student_lists.student_id', 'student_lists.first_name', 'student_lists.middle_initial', 'student_lists.last_name',  'student_lists.course_id', DB::raw('COUNT(computer_records.id) as total_records'))
            ->groupBy('student_lists.student_id', 'student_lists.first_name', 'student_lists.middle_initial', 'student_lists.last_name', 'student_lists.course_id')
            ->orderByDesc('total_records')
            ->take(10)
            ->get();
        return view('admin.computer.start-session', compact('rankedStudents'));
    }

    public function handleComputerTime(Request $request)
    {
        $id = $request->input('id');

        // Log the input ID for debugging
        Log::info('Input ID: ' . $id);

        // Check if the ID exists in the student, faculty, or graduate school table
        $student = StudentList::where('student_id', $id)->first();
        $faculty = FacultyList::where('faculty_id', $id)->first();

        if ($student) {
            return $this->handleComputerRecordTime($id, 'student', $student);
        } elseif ($faculty) {
            return $this->handleComputerRecordTime($id, 'faculty', $faculty);
        } else {
            return redirect()->back()->with('idnotexist', 'ID does not exist.');
        }
    }

    protected function handleComputerRecordTime($id, $type, $entity)
    {
        $column = $type . '_id';
        $latestRecord = ComputerRecords::where($column, $id)->latest()->first();

        if ($latestRecord) {
            $recordDate = Carbon::parse($latestRecord->created_at)->toDateString();
            $currentDate = Carbon::now()->toDateString();

            if ($recordDate === $currentDate) {
                if ($latestRecord->time_out === null) {
                    return $this->timeOut($latestRecord, $entity, $type);
                } else {
                    $timeOut = Carbon::parse($latestRecord->time_out);
                    $currentTime = Carbon::now();
                    $diffInSeconds = $currentTime->diffInSeconds($timeOut);

                    if ($diffInSeconds < 20) {
                        return redirect()->back()->with('20seconds-out-' . $type, 'Cannot time in within 20 seconds of time out.')
                            ->with($type, $entity)
                            ->with('currentTime', Carbon::now()->format('h:i A'));
                    }
                }
            } else {
                return $this->timeIn($id, $type, $entity);
            }
        } else {
            return $this->timeIn($id, $type, $entity);
        }

        return $this->timeIn($id, $type, $entity);
    }

    protected function timeIn($id, $type, $entity)
    {
        $column = $type . '_id';
        $record = new ComputerRecords();
        $record->$column = $id;
        $record->time_in = Carbon::now()->toTimeString();
        $record->save();

        return redirect()->back()->with($type . 'Timein', ucfirst($type) . ' time in recorded successfully.')
            ->with($type, $entity)
            ->with('currentTime', Carbon::now()->format('h:i A'));
    }

    protected function timeOut($latestRecord, $entity, $type)
    {
        $timeIn = Carbon::parse($latestRecord->time_in);
        $currentTime = Carbon::now();
        $diffInSeconds = $currentTime->diffInSeconds($timeIn);

        if ($diffInSeconds < 20) {
            return redirect()->back()->with('20seconds-in-' . $type, 'Cannot time out within 20 seconds of time in.')
                ->with($type, $entity)
                ->with('currentTime', Carbon::now()->format('h:i A'));
        }

        $latestRecord->time_out = $currentTime->toTimeString();
        $latestRecord->save();

        return redirect()->back()->with($type . 'Timeout', ucfirst($type) . ' time out recorded successfully.')
            ->with($type, $entity)
            ->with('currentTime', Carbon::now()->format('h:i A'));
    }

    public function showTodayTimeIns()
    {
        $todayDate = now()->timezone('Asia/Manila')->toDateString();

        $recordsTimedInToday = ComputerRecords::whereDate('created_at', $todayDate)
            ->whereNotNull('time_in')
            ->get();

        foreach ($recordsTimedInToday as $record) {
            $timeIn = Carbon::parse($record->time_in);
            $timeOut = Carbon::parse($record->time_out);
            $record->duration = $timeOut ? $timeOut->diff($timeIn)->format('%H:%I:%S') : 'N/A';
        }

        return view('admin.student.session.active-session', [
            'recordsTimedInToday' => $recordsTimedInToday,
        ]);
    }

    public function allComputerRecords(Request $request)
    {
        $todayDate = now()->timezone('Asia/Manila')->toDateString();

        // Get filter dates from the request
        $startDate = $request->input('start_date') ?? '07/01/2024';
        $endDate = $request->input('end_date');

        // Default to today if no dates are provided
        if (!$endDate) {
            $endDate = $todayDate;
        }

        // Adjust end date to include the entire day
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Get all sessions that have a time_in within the specified date range with student data
        $filteredSessions = ComputerRecords::whereBetween('created_at', [$startDate, $endDate])
            ->with('student', 'faculty')
            ->get();

        foreach ($filteredSessions as $computerRecords) {
            if ($computerRecords->time_out) {
                $timeIn = Carbon::parse($computerRecords->time_in);
                $timeOut = Carbon::parse($computerRecords->time_out);
                $duration = $timeIn->diff($timeOut)->format('%H:%I:%S');
                $computerRecords->duration = $duration;
            } else {
                $computerRecords->duration = null;
            }
        }

        $sessionsByDay = $filteredSessions->groupBy(function ($session) {
            return $session->created_at->format('F j, Y');
        });

        return view('admin.computer.all-computer-records', [
            'sessionsByDay' => $sessionsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }

}
