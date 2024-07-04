<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'auth'])
    ->middleware(['auth'])->name('home');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // dashboard routes
    Route::get('/student-records', [DashboardController::class, 'combinedDashboard'])->name('student.records.dashboard');
    // student
    Route::get('/student-list', [StudentController::class, 'studentList'])->name('student.list');
    Route::view('/add-student-form', 'admin.student.add-student');
    Route::post('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
    Route::get('edit/{id}', [StudentController::class, 'edit_student']);
    Route::POST('/update-student', [StudentController::class, 'update_student'])->name('update.student');
    Route::get('delete/{id}', [StudentController::class, 'delete_student']);
    Route::get('/all-student-records', [StudentController::class, 'allStudentRecords'])->name('student.records');

    // faculty and staff
    Route::get('/faculty-list', [FacultyController::class, 'facultyList'])->name('faculty.list');
    Route::view('/add-faculty-form', 'admin.faculty.add-faculty');
    Route::post('/add-faculty', [FacultyController::class, 'addFaculty'])->name('add.faculty');
    Route::get('edit-faculty/{id}', [FacultyController::class, 'edit_faculty']);
    Route::POST('/update-faculty', [FacultyController::class, 'update_faculty'])->name('update.faculty');
    Route::get('delete-faculty/{id}', [FacultyController::class, 'delete_faculty']);
    Route::get('/all-faculty-records', [FacultyController::class, 'allFacultyRecords'])->name('faculty.records');

    // session
    Route::get('/session-page', [SessionController::class, 'startSessionPage'])->name('session.page');
    Route::post('/session-store', [SessionController::class, 'createSession'])->name('session.store');

    Route::get('/active-session', [SessionController::class, 'showTodayTimeIns'])->name('active.session.view');

    //session management
    // Route::post('/time-in', [SessionController::class, 'timeIn'])->name('time-in');
    // Route::post('/time-out', [SessionController::class, 'timeOut'])->name('time-out');
    Route::post('/student-time', [SessionController::class, 'handleTime'])->name('student-time');
    // search
    Route::get('/search-student', [SearchController::class, 'searchStudent'])->name('search.student');
    Route::get('/search-faculty', [SearchController::class, 'searchFaculty'])->name('search.faculty');


    // import data
    Route::view('/import-student-data-form', 'admin.student.import-excel-data');
    Route::POST('/import-student-data', [ImportDataController::class, 'importStudentData'])->name('import.student.data');
    Route::view('/import-faculty-data-form', 'admin.faculty.import-excel-data');
    Route::POST('/import-faculty-data', [ImportDataController::class, 'importFacultyData'])->name('import.faculty.data');

    // export pdf
    Route::get('/export-students-pdf', [PDFController::class, 'StudentRecordsPDF'])->name('student-records.pdf');
    Route::get('/export-faculty-pdf', [PDFController::class, 'FacultyRecordsPDF'])->name('faculty-records.pdf');
});
