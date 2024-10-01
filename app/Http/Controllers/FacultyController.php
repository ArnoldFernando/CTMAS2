<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Course;
use App\Models\FacultyList;
use App\Models\FacultyRecords;
use App\Models\GraduateSchoolList;
use App\Models\StudentList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function create()
    {
        $colleges = College::all();
        $colors = [
            '#FFDDDD', '#DDFFDD', '#DDDDFF', '#FFFFDD', '#DDFFFF',
            '#FFDDFF', '#FFD700', '#ADD8E6', '#FFA07A', '#FFB6C1',
        ];

        foreach ($colleges as $college) {
            $college->bg_color = $colors[array_rand($colors)];
        }

        return view('admin.faculty.create', compact('colleges', 'colors'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'faculty_id' => 'required|string|max:15',
            'first_name' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:10',
            'last_name' => 'required|string|max:50',
            'college_id' => 'nullable|string|max:15',
            'image' => 'nullable|max:50000',
        ]);

        $existingStudentInList = StudentList::where('student_id', $request->faculty_id)->exists();
        $existingFaculty = FacultyList::where('faculty_id', $request->faculty_id)->exists();

        if ($existingStudentInList || $existingFaculty) {
            session()->flash('error', 'Student ID already exists in the system!');
            return redirect()->back();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('faculty-images'), $imageName);
        }

        FacultyList::create([
            'faculty_id' => $request->faculty_id,
            'first_name' => $request->first_name,
            'middle_initial' => $request->middle_initial,
            'last_name' => $request->last_name,
            'college_id' => $request->college_id,
            'image' => $imageName,
        ]);

        session()->flash('success', 'Data saved successfully!');
        return redirect()->back();
    }

    public function index()
    {
        $data = FacultyList::all()->groupBy(function ($item) {
            return strtolower($item->college);
        });
        return view('admin.faculty.index', ['Faculty_lists' => $data]);
    }

    public function edit($id)
    {
        $colleges = College::all();
        $faculty = FacultyList::findOrFail($id); // Assuming you're fetching a student from the database
        return view('admin.faculty.update', compact('faculty', 'colleges'));
    }

    public function update(Request $req, $faculty_id )
    {
        // Retrieve the student record
        $data = FacultyList::where('faculty_id', $faculty_id)->first();

        $existingFaculty = FacultyList::where('faculty_id', $req->faculty_id)
        ->where('faculty_id', '!=', $faculty_id)
        ->first();

        if ($existingFaculty) {
        session()->flash('error', 'Faculty ID already exists!');
        return redirect()->back()->withInput();
        }
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
        $data->first_name = $req->first_name;
        $data->middle_initial = $req->middle_initial;
        $data->last_name = $req->last_name;
        $data->college_id = $req->college_id;
        $data->updated_at = now();
        $data->save();

        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('faculty.index');
    }


    public function delete_faculty(string $id)
    {
        $data = FacultyList::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function records(Request $request)
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

        return view('admin.faculty.records.records', [
            'sessionsByDay' => $sessionsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }

}
