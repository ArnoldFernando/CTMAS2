<?php

namespace App\Http\Controllers;

use App\Imports\importFacultyData;
use App\Imports\importGradschoolData;
use App\Imports\ImportStudentData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    public function importStudentData(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $import = new ImportStudentData;
        Excel::import($import, $request->file('file'));

        $existingRecords = $import->getExistingRecords();

        return redirect()->route('student.list')->with([
            'status' => 'Imported successfully',
            'existingRecords' => $existingRecords
        ]);
    }


    public function importFacultyData(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        Excel::import(new importFacultyData, $request->file('file'));

        return redirect()->route('faculty.list')->with('status', 'Imported successfully');
    }

    public function importGradschoolData(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        Excel::import(new importGradschoolData, $request->file('file'));

        return redirect()->route('gradSchool.list')->with('status', 'Imported successfully');
    }
}
