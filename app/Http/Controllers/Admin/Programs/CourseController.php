<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all colleges to populate the college dropdown
        $colleges = College::all();

        // Fetch all courses to display existing courses
        $courses = Course::with('college')->get();

        return view('admin.course.create', compact('colleges', 'courses'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $existingCourse = Course::where('course_id', $request->course_id)->exists();

        if ($existingCourse) {
            // If student ID exists in any table, show an error message
            session()->flash('error', 'Student ID already exists in the system!');
            return redirect()->back();
        }
        // Validate the incoming request data
        $validatedData = $request->validate([
            'course_id' => 'required|string|max:15|unique:courses',
            'course_name' => 'required|string|max:100',
            'type' => 'required|in:undergraduateschool,graduateschool',
            'college_id' => 'nullable|string|max:15', // nullable if it's a graduateschool
        ]);

        // Create the new course
        $course = new Course();
        $course->course_id = $validatedData['course_id'];
        $course->course_name = $validatedData['course_name'];
        $course->type = $validatedData['type'];

        // Only set college_id if type is 'undergraduateschool'
        if ($validatedData['type'] === 'undergraduateschool') {
            $course->college_id = $validatedData['college_id'];
        } else {
            $course->college_id = null; // No college_id for graduateschool courses
        }

        $course->save();

        // Redirect back to the form with a success message
        return redirect()->route('create.course')->with('success', 'Course added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
