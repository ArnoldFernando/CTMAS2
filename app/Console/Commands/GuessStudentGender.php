<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudentList;
use Illuminate\Support\Facades\Http;

class GuessStudentGender extends Command
{
    protected $signature = 'student:guess';
    protected $description = 'Guess and update the sex field of students using Genderize.io based on first names';

    public function handle()
    {
        $students = StudentList::whereNull('sex')->orWhere('sex', '')->get();

        $this->info("Found " . $students->count() . " students with missing sex...");

        foreach ($students as $student) {
            $firstName = $student->first_name;

            $response = Http::get("https://api.genderize.io", [
                'name' => $firstName
            ]);

            if ($response->successful()) {
                $gender = $response->json()['gender'];

                if ($gender) {
                    $student->sex = ucfirst($gender); // e.g., male -> Male
                    $student->save();

                    $this->info("Updated {$student->first_name} {$student->last_name} => {$student->sex}");
                } else {
                    $this->warn("No gender found for: $firstName");
                }

                sleep(1); // Avoid hitting rate limits
            } else {
                $this->error("API failed for: $firstName");
            }
        }

        $this->info("Done updating student genders.");
    }
}
