<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Course;
use App\Models\Faculty_and_staff;
use App\Models\FacultyList;
use App\Models\GraduateSchoolList;
use App\Models\StudentList;
use App\Models\StudentRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function create()
    {
        $colleges = College::all();
        $courses = Course::where('type', 'undergraduateschool')->get()->groupBy('college_id');
        $colors = [
            '#FFDDDD', '#DDFFDD', '#DDDDFF', '#FFFFDD', '#DDFFFF',
            '#FFDDFF', '#FFD700', '#ADD8E6', '#FFA07A', '#FFB6C1',
        ];
        foreach ($courses as $course) {
            $course->bg_color = $colors[array_rand($colors)];
        }
        return view('admin.student.create', compact('colleges', 'courses', 'colors'));
    }

    public function index(Request $req)
    {
        $query = StudentList::where('status', 'undergraduateschool');
        // Check if a specific course is selected for filtering
        if ($req->has('course_id') && $req->course_id != '') {
            $query->where('course_id', $req->course_id);
        }
        // Group the results by course
        $data = $query->get()->groupBy(function ($item) {
            return strtolower($item->course_id);
        });
        // Pass all available courses to the view for filtering options
        $courses = StudentList::where('status', 'undergraduateschool')->pluck('course_id')->unique();
        return view('admin.student.index', ['Student_lists' => $data, 'courses' => $courses, 'selectedCourse' => $req->course_id]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_id' => 'required|string|max:15',
            'first_name' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:10',
            'last_name' => 'required|string|max:50',
            'college_id' => 'nullable|string|max:15',
            'course_id' => 'nullable|string|max:15',
            'year' => 'nullable|smallint|max:10',
            'status' => 'enum:undergraduateschool,graduateschool',
            'image' => 'nullable|max:50000', // Adjust validation as needed
        ]);

        // Check if the student ID exists in either StudentList, Faculty_and_staff, or GraduateSchoolList
        $existingStudentInList = StudentList::where('student_id', $request->student_id)->exists();
        $existingFaculty = FacultyList::where('faculty_id', $request->student_id)->exists();
        // $existingGraduateSchool = GraduateSchoolList::where('graduateschool_id', $request->student_id)->exists();

        if ($existingStudentInList || $existingFaculty) {
            // If student ID exists in any table, show an error message
            session()->flash('error', 'Student ID already exists in the system!');
            return redirect()->back();
        }

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('student-images'), $imageName);
        }

        // Create a new student record
        StudentList::create([
            'student_id' => $request->student_id,
            'first_name' => $request->first_name,
            'middle_initial' => $request->middle_initial,
            'last_name' => $request->last_name,
            'course_id' => $request->course_id,
            'college_id' => $request->college_id,
            'year' => $request->year,
            'image' => $imageName,
            'status' => 'undergraduateschool', // Or adjust based on your needs
        ]);



        // Flash success message
        session()->flash('success', 'Data saved successfully!');
        return redirect()->back();
    }



    public function edit($id)
    {
        $colleges = College::all();
        $courses = Course::where('type', 'undergraduateschool')->get()->groupBy('college_id');
        $colors = [
            '#FFDDDD', '#DDFFDD', '#DDDDFF', '#FFFFDD', '#DDFFFF',
            '#FFDDFF', '#FFD700', '#ADD8E6', '#FFA07A', '#FFB6C1',
        ];
        foreach ($courses as $course) {
            $course->bg_color = $colors[array_rand($colors)];
        }
        $student = Studentlist::with('course')->findOrFail($id); // Assuming you're fetching a student from the database
        return view('admin.student.update', compact('student', 'colors', 'colleges', 'courses'));
    }

    public function update(Request $req, $student_id)
    {
        // Retrieve the student record
        $data = StudentList::where('student_id', $student_id)->first();
        $existingStudent = StudentList::where('student_id', $req->student_id)
        ->where('student_id', '!=', $student_id)
        ->first();

        if ($existingStudent) {
        session()->flash('error', 'Student ID already exists!');
        return redirect()->back()->withInput();
        }
        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('student-images'), $imageName);
            $data->image = $imageName;
        }
        $data->student_id = $req->student_id;
        $data->first_name = $req->first_name;
        $data->middle_initial = $req->middle_initial;
        $data->last_name = $req->last_name;
        $data->course_id = $req->course_id;
        $data->college_id = $req->college_id;
        $data->year = $req->year;
        $data->updated_at = now();
        $data->save();
        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('student.index');
    }

    public function delete_student(string $id)
    {
        $data = StudentList::find($id);
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
        $colleges = College::all();
        // Adjust end date to include the entire day
        $endDate = Carbon::parse($endDate)->endOfDay();
        // Get all sessions that have a time_in within the specified date range with student data
        $filteredSessions = StudentRecords::whereBetween('created_at', [$startDate, $endDate])
            ->whereHas('student', function ($query) {
                $query->where('status', 'undergraduateschool');
            })
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
        return view('admin.student.records.all-records', [
            'sessionsByDay' => $sessionsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate->format('Y-m-d'),
            'colleges' => $colleges,
        ]);
    }
}
