<?php

namespace App\Http\Controllers;

use App\Models\FacultyList;
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
        $query = StudentList::where('status', 'undergraduateschool');

    // Check if a specific course is selected for filtering
    if ($request->has('course_id') && $request->course_id != '') {
        $query->where('course_id', $request->course_id);
    }

    // Group the results by course
    $data = $query->get()->groupBy(function ($item) {
        return strtolower($item->course_id);
    });

    // Pass all available courses to the view for filtering options
    $courses = StudentList::where('status', 'undergraduateschool')->pluck('course_id')->unique();
        $query = $request->input('query');
        // Perform your search logic here using Eloquent ORM or other methods
        $results = StudentList::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('first_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('student_id', 'like', '%' . $query . '%')
                ->orWhere('year', 'like', '%' . $query . '%')
                ->orWhere('course_id', 'like', '%' . $query . '%')
                ->orWhere('college_id', 'like', '%' . $query . '%');
        })->get();
        return view('admin.student.index', ['Student_lists' => $data, 'results' => $results, 'courses' => $courses, 'selectedCourse' => $request->course_id])->with('input', $request->all());
    }

    public function searchStudentRecords(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = StudentRecords::whereHas('student', function ($q) use ($query) {
                $q->where('status', 'undergraduateschool')  // Add this condition to filter undergraduate students
                  ->where(function ($q) use ($query) {  // Nested condition for the search query
                    $q->where('first_name', 'like', '%' . $query . '%')
                        ->orWhere('last_name', 'like', '%' . $query . '%')
                        ->orWhere('student_id', 'like', '%' . $query . '%')
                        ->orWhere('year', 'like', '%' . $query . '%')
                        ->orWhere('course_id', 'like', '%' . $query . '%')
                        ->orWhere('college_id', 'like', '%' . $query . '%');
                });
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
        $results = FacultyList::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('first_name', 'like', '%' . $query . '%')
            ->orWhere('last_name', 'like', '%' . $query . '%')
            ->orWhere('faculty_id', 'like', '%' . $query . '%')
            ->orWhere('college_id', 'like', '%' . $query . '%');
        })->get();

        return view('admin.faculty.list', compact('results'))->with('input', $request->all());
    }

    public function searchFacultyRecords(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = FacultyRecords::whereHas('faculty', function ($q) use ($query) {
                $q->where('first_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('faculty_id', 'like', '%' . $query . '%')
                ->orWhere('college_id', 'like', '%' . $query . '%');
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
        $results = StudentList::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('first_name', 'like', '%' . $query . '%')
            ->orWhere('last_name', 'like', '%' . $query . '%')
            ->orWhere('student_id', 'like', '%' . $query . '%')
            ->orWhere('year', 'like', '%' . $query . '%')
            ->orWhere('course_id', 'like', '%' . $query . '%');
        })->get();

        return view('admin.graduateschool.index', compact('results'))->with('input', $request->all());
    }

    public function searchGradschoolRecords(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = StudentRecords::whereHas('student', function ($q) use ($query) {
                $q->where('status', 'graduateschool')  // Add this condition to filter undergraduate students
                  ->where(function ($q) use ($query) {  // Nested condition for the search query
                      $q->where('first_name', 'like', '%' . $query . '%')
                        ->orWhere('last_name', 'like', '%' . $query . '%')
                        ->orWhere('student_id', 'like', '%' . $query . '%')
                        ->orWhere('year', 'like', '%' . $query . '%')
                        ->orWhere('course_id', 'like', '%' . $query . '%');
                });
            })->get();

            // Pass the search results to the view
            return redirect()->route('gradschool.records')->with([
                'results' => $results,
                'input' => $request->all(),
            ]);
        }

        return redirect()->route('gradschool.records');
    }
}
