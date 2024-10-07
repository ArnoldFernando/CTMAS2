<?php

namespace App\Http\Controllers;

use App\Imports\importFacultyData;
use App\Imports\importGradschoolData;
use App\Imports\ImportStudentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    public function importStudentData(Request $request)
    {
        $existingRecords = null; // Initialize variable to avoid undefined variable error
        try {
            // Validate the file input
            $request->validate([
                'file' => 'required|file|mimes:xls,xlsx',
            ]);

            // Import the data
            $import = new ImportStudentData;
            Excel::import($import, $request->file('file'));

            // Get any existing records if the import was successful
            $existingRecords = $import->getExistingRecords();

            // Flash a success message
            Session::flash('success', 'Student list imported successfully.');
        } catch (\Exception $e) {
            // Flash an error message if import fails
            Session::flash('error', 'Failed to import student list. Please check the file and try again.');
        }

        // Redirect to the student list route with any existing records (if applicable)
        return redirect()->route('student.list')->with('existingRecords', $existingRecords);
    }


    public function importFacultyData(Request $request)
    {

        $existingRecords = null; // Initialize variable to avoid undefined variable error
        try {
            // Validate the file input
            $request->validate([
                'file' => 'required|file|mimes:xls,xlsx',
            ]);

            // Import the data
            $import = new importFacultyData();
            Excel::import($import, $request->file('file'));

            // Get any existing records if the import was successful
            $existingRecords = $import->getExistingRecords();

            // Flash a success message
            Session::flash('success', 'faculty list imported successfully.');
        } catch (\Exception $e) {
            // Flash an error message if import fails
            Session::flash('error', 'Failed to import faculty list. Please check the file and try again.');
        }

        // Redirect to the student list route with any existing records (if applicable)
        return redirect()->route('faculty.index')->with('existingRecords', $existingRecords);
    }

    public function importGradschoolData(Request $request)
    {

        $existingRecords = null; // Initialize variable to avoid undefined variable error
        try {
            // Validate the file input
            $request->validate([
                'file' => 'required|file|mimes:xls,xlsx',
            ]);

            // Import the data
            $import = new importGradschoolData();
            Excel::import($import, $request->file('file'));

            // Get any existing records if the import was successful
            $existingRecords = $import->getExistingRecords();

            // Flash a success message
            Session::flash('success', 'faculty list imported successfully.');
        } catch (\Exception $e) {
            // Flash an error message if import fails
            Session::flash('error', 'Failed to import faculty list. Please check the file and try again.');
        }

        // Redirect to the student list route with any existing records (if applicable)
        return redirect()->route('gradschool.list')->with('existingRecords', $existingRecords);

    }
}
