<?php

namespace App\Imports;


use App\Models\FacultyList;
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

        // Check if the ID already exists in both tables
        $existingStudent = $studentId ? StudentList::where('student_id', $studentId)->first() : null;
        $existingFaculty = $facultyId ? FacultyList::where('faculty_id', $facultyId)->first() : null;

        // Also ensure that a student_id cannot exist in FacultyList and a faculty_id cannot exist in StudentList
        $conflictingFaculty = $studentId ? FacultyList::where('faculty_id', $studentId)->first() : null;
        $conflictingStudent = $facultyId ? StudentList::where('student_id', $facultyId)->first() : null;

        if (!$existingStudent && !$existingFaculty && !$conflictingFaculty && !$conflictingStudent) {
            return new StudentList([
                'student_id' => $studentId,
                'first_name' => $row['first_name'],
                'middle_initial' => $row['middle_initial'],
                'last_name' => $row['last_name'],
                'course_id' => $row['course_id'],
                'status' => 'graduateschool'
            ]);
        } else {
            // Collect the conflicting IDs and specify the table they exist in
            if ($existingStudent || $conflictingFaculty) {
                $this->existingRecords->push(['id' => $studentId, 'type' => 'student', 'table' => $existingStudent ? 'StudentList' : 'FacultyList']);
            }
            if ($existingFaculty || $conflictingStudent) {
                $this->existingRecords->push(['id' => $facultyId, 'type' => 'faculty', 'table' => $existingFaculty ? 'FacultyList' : 'StudentList']);
            }
            return null;
        }
    }

    public function getExistingRecords()
    {
        return $this->existingRecords;
    }
}
