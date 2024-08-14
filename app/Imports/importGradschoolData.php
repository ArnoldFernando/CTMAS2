<?php

namespace App\Imports;

use App\Models\Faculty_and_staff;
use App\Models\GraduateSchoolList;
use App\Models\StudentList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importGradschoolData implements ToModel, WithHeadingRow
{
    private $existingRecords;

    public function __construct()
    {
        $this->existingRecords = collect();
    }

    public function model(array $row)
    {
        $studentId = $row['student_id'] ?? null;
        $facultyId = $row['faculty_id'] ?? null;
        $graduateSchoolId = $row['graduateschool_id'] ?? null;

        // Check if the IDs already exist in the respective tables
        $existingStudent = $studentId ? StudentList::where('student_id', $studentId)->first() : null;
        $existingFaculty = $facultyId ? Faculty_and_staff::where('faculty_id', $facultyId)->first() : null;
        $existingGraduateSchool = $graduateSchoolId ? GraduateSchoolList::where('graduateschool_id', $graduateSchoolId)->first() : null;

        if (!$existingStudent && !$existingFaculty && !$existingGraduateSchool) {
            return new StudentList([
                'graduateschool_id' => $graduateSchoolId,

                'name' => $row['name'],
                'course' => $row['course'],
            ]);
        } else {
            // Collect the IDs that already exist and specify the table
            if ($existingStudent) {
                $this->existingRecords->push(['id' => $studentId, 'type' => 'student', 'table' => 'StudentList']);
            }
            if ($existingFaculty) {
                $this->existingRecords->push(['id' => $facultyId, 'type' => 'faculty', 'table' => 'FacultyList']);
            }
            if ($existingGraduateSchool) {
                $this->existingRecords->push(['id' => $graduateSchoolId, 'type' => 'graduate school', 'table' => 'GraduateSchoolList']);
            }

            return null;
        }
    }

    public function getExistingRecords()
    {
        return $this->existingRecords;
    }
}
