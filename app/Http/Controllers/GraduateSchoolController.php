<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\GraduateSchoolList;
use App\Models\GraduateSchoolRecords;
use App\Models\StudentList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraduateSchoolController extends Controller
{
    //
    public function gradschoollist()
    {
        $data = GraduateSchoolList::all()->groupBy(function ($item) {
            return strtolower($item->course);
        });
        return view('admin.graduateschool.list', ['GradSchool_lists' => $data]);
    }

    public function addGraduateSchool(Request $request)
    {
        $existingGradschool = GraduateSchoolList::where('graduateschool_id', $request->graduateschool_id)->first();

        $student = StudentList::where('student_id', $request->graduateschool_id)->first();
        $faculty = Faculty_and_staff::where('faculty_id', $request->graduateschool_id)->first();

        $existingStudentInAnotherTable = $student || $faculty;
        if ($existingGradschool) {
            session()->flash('error', 'Graduate School ID already exists!');
            return redirect()->back();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('graduateschool-images'), $imageName);
        } else {
            $imageName = null; // If no image is uploaded, set imageName to null or specify a default image path
        }

        // Create new student record
        $gradschool = new GraduateSchoolList();
        $gradschool->graduateschool_id = $request->graduateschool_id;
        $gradschool->name = $request->name;
        $gradschool->course = $request->course;
        $gradschool->image = $imageName; // Save the image path or filename
        $gradschool->created_at = now();
        $gradschool->updated_at = now();
        $gradschool->save();

        session()->flash('success', 'Data saved successfully!');
        return redirect()->back();
    }

    public function edit_gradschool($id)
    {
        $gradschool = GraduateSchoolList::findOrFail($id); // Assuming you're fetching a student from the database
        return view('admin.graduateschool.update-graduateschool', ['GradSchool_list' => $gradschool]);
    }


    public function update_gradschool(Request $req)
    {
        // Retrieve the student record
        $data = GraduateSchoolList::find($req->id);

        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('graduateschool-images'), $imageName);

            // Update the image field with the new image
            $data->image = $imageName;
        }

        // Update other fields
        $data->graduateschool_id = $req->graduateschool_id;
        $data->name = $req->name;
        $data->course = $req->course;
        $data->updated_at = now();
        $data->save();

        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('gradSchool.list');
    }

    public function delete_gradschool(string $id)
    {
        $data = GraduateSchoolList::find($id);
        $data->delete();

        return redirect()->back();
    }





    public function allgradschoolRecords(Request $request)
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
        $filteredSessions = GraduateSchoolRecords::whereBetween('created_at', [$startDate, $endDate])
            ->with('graduateschool')
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

        return view('admin.graduateschool.all-graduateschool-records', [
            'sessionsByDay' => $sessionsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }

}
