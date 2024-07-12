<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\StudentList;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchStudent(Request $request)
    {
        $query = $request->input('query');

        // Perform your search logic here using Eloquent ORM or other methods
        $results = StudentList::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('student_id', 'like', '%' . $query . '%')
                ->orWhere('course', 'like', '%' . $query . '%')
                ->orWhere('college', 'like', '%' . $query . '%');
        })->get();

        return view('admin.student.list', compact('results'))->withInput($request->all());
    }


    public function searchFaculty(Request $request)
    {
        $query = $request->input('query');

        // Perform your search logic here using Eloquent ORM or other methods
        $results = Faculty_and_staff::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('faculty_id', 'like', '%' . $query . '%')
                ->orWhere('college', 'like', '%' . $query . '%');
        })->get();

        return view('admin.faculty.list', compact('results'));
    }
}
