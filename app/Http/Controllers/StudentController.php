<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use App\Models\StudentRecords;
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
        $existingStudent = StudentList::where('student_id', $request->student_id)->first();

        if ($existingStudent) {
            session()->flash('error', 'Student ID already exists!');
            return redirect()->back();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null; // If no image is uploaded, set imageName to null or specify a default image path
        }

        // Create new student record
        $addstudent = new StudentList;
        $addstudent->student_id = $request->student_id;
        $addstudent->name = $request->name;
        $addstudent->course = $request->course;
        $addstudent->college = $request->college;
        $addstudent->image = $imageName; // Save the image path or filename
        $addstudent->created_at = now();
        $addstudent->updated_at = now();
        $addstudent->save();

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
            $image->move(public_path('images'), $imageName);

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

}