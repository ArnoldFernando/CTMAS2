<?php

namespace App\Http\Controllers;

use App\Models\Faculty_and_staff;
use App\Models\FacultyRecords;
use App\Models\GraduateSchoolList;
use App\Models\GraduateSchoolRecords;
use App\Models\StudentList;
use App\Models\StudentRecords;
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

        return view('admin.student.list', compact('results'))->with('input', $request->all());
    }

    public function searchStudentRecords(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = StudentRecords::whereHas('student', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('student_id', 'like', '%' . $query . '%')
                    ->orWhere('course', 'like', '%' . $query . '%')
                    ->orWhere('college', 'like', '%' . $query . '%');
            })->get();

            // Pass the search results to the view
            return redirect()->route('student.records')->with([
                'results' => $results,
                'input' => $request->all(),
            ]);
        }

        // If no search query, redirect to the default records view
        return redirect()->route('student.records');
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

        return view('admin.faculty.list', compact('results'))->with('input', $request->all());
    }

    public function searchFacultyRecords(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = FacultyRecords::whereHas('faculty', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('faculty_id', 'like', '%' . $query . '%')
                    ->orWhere('college', 'like', '%' . $query . '%');
            })->get();

            // Pass the search results to the view
            return redirect()->route('faculty.records')->with([
                'results' => $results,
                'input' => $request->all(),
            ]);
        }

        // If no search query, redirect to the default records view
        return redirect()->route('faculty.records');
    }

    public function searchGradschool(Request $request)
    {
        $query = $request->input('query');

        // Perform your search logic here using Eloquent ORM or other methods
        $results = GraduateSchoolList::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('graduateschool_id', 'like', '%' . $query . '%')
                ->orWhere('course', 'like', '%' . $query . '%');
        })->get();

        return view('admin.graduateschool.list', compact('results'))->with('input', $request->all());
    }

    public function searchGradschoolRecords(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = GraduateSchoolRecords::whereHas('graduateschool', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('graduateschool_id', 'like', '%' . $query . '%')
                    ->orWhere('course', 'like', '%' . $query . '%');
            })->get();

            // Pass the search results to the view
            return redirect()->route('gradschool.records')->with([
                'results' => $results,
                'input' => $request->all(),
            ]);
        }

        // If no search query, redirect to the default records view
        return redirect()->route('gradschool.records');
    }
}
