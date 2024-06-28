<?php

namespace App\Http\Controllers;

use App\Imports\ImportStudentData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    public function showImportBlade()
    {
        return view('admin.student.import-excel-data');
    }
    public function importStudentData(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        Excel::import(new ImportStudentData, $request->file('file'));

        return redirect()->route('student.list')->with('status', 'Imported successfully');
    }
}
