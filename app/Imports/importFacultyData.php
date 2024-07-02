<?php

namespace App\Imports;

use App\Models\Faculty_and_staff;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importFacultyData implements ToModel, WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $facultyId = $row['faculty_id'];

        // Check if the student ID already exists in the database
        $existingStudent = Faculty_and_staff::where('faculty_id', $facultyId)->first();

        // If the student ID doesn't exist, create a new record
        if (!$existingStudent) {
            return new Faculty_and_staff([
                'faculty_id' => $row['faculty_id'],
                'name' => $row['name'],
                'college' => $row['college']
            ]);
        } else {
            // If the student ID already exists, skip this row
            return null;
        }
    }
}
