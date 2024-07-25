<?php

namespace App\Imports;

use App\Models\GraduateSchoolList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importGradschoolData implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $gradschoolId = $row['graduateschool_id'];

        // Check if the student ID already exists in the database
        $existingGradschool = GraduateSchoolList::where('graduateschool_id', $gradschoolId)->first();

        // If the student ID doesn't exist, create a new record
        if (!$existingGradschool) {
            return new GraduateSchoolList([
                'graduateschool_id' => $row['graduateschool_id'],
                'name' => $row['name'],
                'course' => $row['course']
            ]);
        } else {
            // If the student ID already exists, skip this row
            return null;
        }
    }
}
