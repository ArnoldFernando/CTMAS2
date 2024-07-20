<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\FacultyRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function facultyList()
    {
        $data = Faculty_and_staff::all()->groupBy(function ($item) {
            return strtolower($item->college);
        });
        return view('admin.faculty.list', ['Faculty_lists' => $data]);
    }

    public function addFaculty(Request $request)
    {
        $existingFaculty = Faculty_and_staff::where('faculty_id', $request->faculty_id)->first();

        if ($existingFaculty) {
            session()->flash('error', 'Faculty ID already exists!');
            return redirect()->back();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('faculty-images'), $imageName);
        } else {
            $imageName = null; // If no image is uploaded, set imageName to null or specify a default image path
        }

        // Create new student record
        $addfaculty = new Faculty_and_staff;
        $addfaculty->faculty_id = $request->faculty_id;
        $addfaculty->name = $request->name;
        $addfaculty->college = $request->college;
        $addfaculty->image = $imageName; // Save the image path or filename
        $addfaculty->created_at = now();
        $addfaculty->updated_at = now();
        $addfaculty->save();

        session()->flash('success', 'Data saved successfully!');
        return redirect()->back();
    }

    public function edit_faculty($id)
    {
        $faculty = Faculty_and_staff::findOrFail($id); // Assuming you're fetching a student from the database
        return view('admin.faculty.update-faculty', ['Faculty_and_staff' => $faculty]);
    }

    public function update_faculty(Request $req)
    {
        // Retrieve the student record
        $data = Faculty_and_staff::find($req->id);

        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('faculty-images'), $imageName);

            // Update the image field with the new image
            $data->image = $imageName;
        }

        // Update other fields
        $data->faculty_id = $req->faculty_id;
        $data->name = $req->name;
        $data->college = $req->college;
        $data->updated_at = now();
        $data->save();

        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('faculty.list');
    }


    public function delete_faculty(string $id)
    {
        $data = Faculty_and_staff::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function allFacultyRecords(Request $request)
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

        // Get all sessions that have a time_in within the specified date range with faculty data
        $filteredSessions = FacultyRecords::whereBetween('created_at', [$startDate, $endDate])
            ->with('faculty')
            ->get();

        foreach ($filteredSessions as $facultyRecord) {
            if ($facultyRecord->time_out) {
                $timeIn = Carbon::parse($facultyRecord->time_in);
                $timeOut = Carbon::parse($facultyRecord->time_out);
                $duration = $timeIn->diff($timeOut)->format('%H:%I:%S');
                $facultyRecord->duration = $duration;
            } else {
                $facultyRecord->duration = null;
            }
        }

        $sessionsByDay = $filteredSessions->groupBy(function ($session) {
            return $session->created_at->format('F j, Y');
        });

        return view('admin.faculty.all-faculty-records', [
            'sessionsByDay' => $sessionsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }

}
