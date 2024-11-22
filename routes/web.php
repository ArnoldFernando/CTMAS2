<?php

use App\Http\Controllers\Admin\Computer\ComputerController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\VisitsController;
use App\Http\Controllers\Admin\Data\ChartCalculatorController;
use App\Http\Controllers\Admin\Data\ChartController;
use App\Http\Controllers\Admin\Data\ImportDataController;
use App\Http\Controllers\Admin\Data\PDFController;
use App\Http\Controllers\Admin\Data\ReportController;
use App\Http\Controllers\Admin\Faculty\FacultyController;
use App\Http\Controllers\Admin\Gradschool\GraduateSchoolController;
use App\Http\Controllers\Admin\Programs\CollegeController;
use App\Http\Controllers\Admin\Programs\CourseController;
use App\Http\Controllers\Admin\Session\SearchController;
use App\Http\Controllers\Admin\Session\SessionController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\BarcodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;


use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Middleware\SuperAdmin;

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
    ->middleware(['auth', 'verified'])->name('home');


    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

        // Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard-visits', [VisitsController::class, 'Visits'])->name('dashboard');

        // Student routes
        Route::resource('student', StudentController::class);
        Route::get('/all-student-records', [StudentController::class, 'records'])->name('student.records');

        // Faculty routes
        Route::resource('faculty', FacultyController::class);
        Route::get('/faculty-records', [FacultyController::class, 'records'])->name('faculty.records');

        // Graduate School routes
        Route::resource('gradschool', GraduateSchoolController::class);
        Route::get('/all-gradschool-records', [GraduateSchoolController::class, 'records'])->name('gradschool.records');

        // Report routes
        Route::get('/student-reports', [ReportController::class, 'StudentReports'])->name('student.reports');
        Route::get('/faculty-reports', [ReportController::class, 'FacultyReports'])->name('faculty.reports');
        Route::get('/graduateschool-reports', [ReportController::class, 'GradschoolReports'])->name('gradschool.reports');

        // Export PDF routes
        Route::get('/export-students-pdf', [PDFController::class, 'StudentRecordsPDF'])->name('student-records.pdf');
        Route::get('/export-faculty-pdf', [PDFController::class, 'FacultyRecordsPDF'])->name('faculty-records.pdf');
        Route::get('/export-graduateschool-pdf', [PDFController::class, 'GradschoolRecordsPDF'])->name('gradschool-records.pdf');

        // Import Excel routes
        Route::view('/import-student-data-form', 'admin.student.records.import-excel-data');
        Route::post('/import-student-data', [ImportDataController::class, 'importStudentData'])->name('import.student.data');
        Route::view('/import-faculty-data-form', 'admin.faculty.records.import-excel-data');
        Route::post('/import-faculty-data', [ImportDataController::class, 'importFacultyData'])->name('import.faculty.data');
        Route::view('/import-gradschool-data-form', 'admin.graduateschool.records.import-excel-data');
        Route::post('/import-gradschool-data', [ImportDataController::class, 'importGradschoolData'])->name('import.gradschool.data');

        // Search routes
        Route::get('/search-student', [SearchController::class, 'searchStudent'])->name('search.student');
        Route::get('/search-student-records', [SearchController::class, 'searchStudentRecords'])->name('search.student.records');
        Route::get('/search-faculty', [SearchController::class, 'searchFaculty'])->name('search.faculty');
        Route::get('/search-faculty-records', [SearchController::class, 'searchFacultyRecords'])->name('search.faculty.records');
        Route::get('/search-graduateschool', [SearchController::class, 'searchGradschool'])->name('search.gradschool');
        Route::get('/search-graduateschool-records', [SearchController::class, 'searchGradschoolRecords'])->name('search.gradschool.records');

        // Session routes
        Route::get('/session-page', [SessionController::class, 'startSessionPage'])->name('session.page');
        Route::get('/ranked-students', [SessionController::class, 'fetchRankedStudents'])->name('ranked.students');
        Route::post('/session-store', [SessionController::class, 'createSession'])->name('session.store');
        Route::get('/active-session', [SessionController::class, 'showTodayTimeIns'])->name('active.session.view');
        Route::post('/student-time', [SessionController::class, 'handleTime'])->name('student-time');
        Route::get('/session-data', [SessionController::class, 'getSessionData'])->name('session.data');

        // Keyboard events shortcuts
        Route::get('/redirect', fn() => redirect('/admin/session-page'))->name('redirect.session');
        Route::get('/redirect-computer', fn() => redirect('/admin/computer-page'))->name('redirect.computer');

        // Programs
        Route::get('/create-college', [CollegeController::class, 'create'])->name('create.college');
        Route::post('/store-college', [CollegeController::class, 'store'])->name('store.college');
        Route::get('/create-course', [CourseController::class, 'create'])->name('create.course');
        Route::post('/store-course', [CourseController::class, 'store'])->name('store.course');

        // Chart routes
        Route::view('/student-monthly-chart', 'admin.chart.monthly-chart');
        Route::get('/chart-data-course', [ChartController::class, 'monthlycourse']);
        Route::get('/chart-data-college', [ChartController::class, 'monthlycollege']);
        Route::view('/student-weekly-chart', 'admin.chart.weekly-chart');
        Route::get('/chart-data-course-week', [ChartController::class, 'weeklycourse']);
        Route::get('/chart-data-college-week', [ChartController::class, 'weeklycollege']);

        // chartcalculator routes
        Route::get('/chart', [ChartCalculatorController::class, 'index']);
        Route::post('/chart', [ChartCalculatorController::class, 'store']);


// Route::get('/chart', [ChartCalculatorController::class, 'index']);
// Route::post('/chart/add', [ChartCalculatorController::class, 'add']);
// Route::post('/chart/clear', [ChartCalculatorController::class, 'clear']);






        // barcode
        Route::get('/students-barcode', [BarcodeController::class, 'studentBarcode'])->name('students.barcode');
        // analysis
        Route::view('analysis-page', 'admin.analysis');
        Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis.result');
        // computer log book
        Route::get('/computer-page', [ComputerController::class, 'computerPage'])->name('computer.page');
        Route::post('/computer-time', [ComputerController::class, 'handleComputerTime'])->name('computer-time');
        Route::get('/all-computer-records', [ComputerController::class, 'allComputerRecords'])->name('computer.records');
        // Super Admin
        // Userlist
        Route::get('/userlist', [SuperAdminController::class, 'userlist'])->name('userlist');
    });
