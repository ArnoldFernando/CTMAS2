<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\GraduateSchoolList;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{


    public function studentList()
    {
        $data = StudentList::all()->groupBy(function ($item) {
            return strtolower($item->course);
        });
        return view('admin.student.list', ['Student_lists' => $data]);
    }


    public function addStudent(Request $request)
    {
        // Check if the student ID exists in either StudentList or AnotherTable
        $existingStudentInList = StudentList::where('student_id', $request->student_id)->first();

        $faculty = Faculty_and_staff::where('faculty_id', $request->student_id)->first();
        $gradschool = GraduateSchoolList::where('graduateschool_id', $request->student_id)->first();

        $existingStudentInAnotherTable = $faculty || $gradschool;

        if ($existingStudentInList || $existingStudentInAnotherTable) {
            // If student ID exists in either table, show an error message
            session()->flash('error', 'Student ID already exists in the system!');
            return redirect()->back();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('student-images'), $imageName);
        } else {
            $imageName = null; // Set imageName to null if no image is uploaded
        }

        // Create a new student record
        $addstudent = new StudentList;
        $addstudent->student_id = $request->student_id;
        $addstudent->name = $request->name;
        $addstudent->course = $request->course;
        $addstudent->college = $request->college;
        $addstudent->image = $imageName; // Save the image path or filename
        $addstudent->created_at = now();
        $addstudent->updated_at = now();
        $addstudent->save();

        // Flash success message
        session()->flash('success', 'Data saved successfully!');
        return redirect()->back();
    }


    public function edit_student($id)
    {
        $student = Studentlist::findOrFail($id); // Assuming you're fetching a student from the database
        return view('admin.student.update-student', ['Student_list' => $student]);
    }

    public function update_student(Request $req)
    {
        // Retrieve the student record
        $data = StudentList::find($req->id);

        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('student-images'), $imageName);

            // Update the image field with the new image
            $data->image = $imageName;
        }

        // Update other fields
        $data->student_id = $req->student_id;
        $data->name = $req->name;
        $data->course = $req->course;
        $data->college = $req->college;
        $data->updated_at = now();
        $data->save();

        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('student.list');
    }

    public function delete_student(string $id)
    {
        $data = StudentList::find($id);
        $data->delete();

        return redirect()->back();
    }


    public function allStudentRecords(Request $request)
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
        $filteredSessions = StudentRecords::whereBetween('created_at', [$startDate, $endDate])
            ->with('student')
            ->get();

        foreach ($filteredSessions as $studentRecord) {
            if ($studentRecord->time_out) {
                $timeIn = Carbon::parse($studentRecord->time_in);
                $timeOut = Carbon::parse($studentRecord->time_out);
                $duration = $timeIn->diff($timeOut)->format('%H:%I:%S');
                $studentRecord->duration = $duration;
            } else {
                $studentRecord->duration = null;
            }
        }

        $sessionsByDay = $filteredSessions->groupBy(function ($session) {
            return $session->created_at->format('F j, Y');
        });

        return view('admin.student.session.all-student-records', [
            'sessionsByDay' => $sessionsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }



}
