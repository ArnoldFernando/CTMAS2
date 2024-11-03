<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ComputerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraduateSchoolController;
use App\Http\Controllers\ImportDataController;
use App\Http\Controllers\Programs\CollegeController;
use App\Http\Controllers\Programs\CourseController;
use App\Http\Controllers\ReportController;
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

    // dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'combinedDashboard'])->name('dashboard');
    // student routes
    Route::middleware('auth')->group(function () {
        Route::resource('student', StudentController::class);
        Route::get('/all-student-records', [StudentController::class, 'records'])->name('student.records');
    });

    // faculty routes
    Route::middleware('auth')->group(function () {
        Route::resource('faculty', FacultyController::class);
        Route::get('/faculty-records', [FacultyController::class, 'records'])->name('faculty.records');
    });

    // GRADUATE SCHOOL ROUTES
    Route::middleware('auth')->group(function () {
        Route::resource('gradschool', GraduateSchoolController::class);
        Route::get('/all-gradschool-records', [GraduateSchoolController::class, 'records'])->name('gradschool.records');
    });

    // report routes
    Route::middleware('auth')->group(function () {
        Route::get('/student-reports', [ReportController::class, 'StudentReports'])->name('student.reports');
        Route::get('/faculty-reports', [ReportController::class, 'FacultyReports'])->name('faculty.reports');
        Route::get('/Graduateschool-reports', [ReportController::class, 'GradschoolReports'])->name('gradschool.reports');
    });

    // export-pdf routes
    Route::middleware('auth')->group(function () {
        Route::get('/export-students-pdf', [PDFController::class, 'StudentRecordsPDF'])->name('student-records.pdf');
        Route::get('/export-faculty-pdf', [PDFController::class, 'FacultyRecordsPDF'])->name('faculty-records.pdf');
        Route::get('/export-graduateschool-pdf', [PDFController::class, 'GradschoolRecordsPDF'])->name('gradschool-records.pdf');
    });

    // import-excel routes
    Route::middleware('auth')->group(function () {
        // student
        Route::view('/import-student-data-form', 'admin.student.records.import-excel-data');
        Route::POST('/import-student-data', [ImportDataController::class, 'importStudentData'])->name('import.student.data');
        // faculty
        Route::view('/import-faculty-data-form', 'admin.faculty.records.import-excel-data');
        Route::POST('/import-faculty-data', [ImportDataController::class, 'importFacultyData'])->name('import.faculty.data');
        // graduateschool
        Route::view('/import-gradschool-data-form', 'admin.graduateschool.records.import-excel-data');
        Route::POST('/import-gradschool-data', [ImportDataController::class, 'importGradschoolData'])->name('import.gradschool.data');
    });

    // search routes
    Route::middleware('auth')->group(function () {
        // student
        Route::get('/search-student', [SearchController::class, 'searchStudent'])->name('search.student');
        Route::get('/search-student-records', [SearchController::class, 'searchStudentRecords'])->name('search.student.records');
        // faculty
        Route::get('/search-faculty', [SearchController::class, 'searchFaculty'])->name('search.faculty');
        Route::get('/search-faculty-records', [SearchController::class, 'searchFacultyRecords'])->name('search.faculty.records');
        // graduateschool
        Route::get('/search-graduateschool', [SearchController::class, 'searchGradschool'])->name('search.gradschool');
        Route::get('/search-graduateschool-records', [SearchController::class, 'searchGradschoolRecords'])->name('search.gradschool.records');
    });

    // session
    Route::middleware('auth')->group(function () {
        Route::get('/session-page', [SessionController::class, 'startSessionPage'])->name('session.page');
        Route::get('/ranked-students', [SessionController::class, 'fetchRankedStudents'])->name('ranked.students');
        Route::post('/session-store', [SessionController::class, 'createSession'])->name('session.store');
        Route::get('/active-session', [SessionController::class, 'showTodayTimeIns'])->name('active.session.view');
        Route::post('/student-time', [SessionController::class, 'handleTime'])->name('student-time');
        Route::get('/session-data', [SessionController::class, 'getSessionData'])->name('session.data');


        // keyboard events f1 and f2 shortcut for session
        Route::get('/redirect', function () {
            return redirect('/admin/session-page');
        })->name('redirect.session');
        Route::get('/redirect-computer', function () {
            return redirect('/admin/computer-page');
        })->name('redirect.computer');
    });

       // Programs
    Route::middleware('auth')->group(function () {
     // college
    Route::get('/create-college', [CollegeController::class, 'create'])->name('create.college');
    Route::post('/store-college', [CollegeController::class, 'store'])->name('store.college');
    // course
    Route::get('/create-course', [CourseController::class, 'create'])->name('create.course');
    Route::post('/store-course', [CourseController::class, 'store'])->name('store.course');
    });


// chart
    Route::middleware('auth')->group(function () {
        Route::view('/student-monthly-chart', 'admin.chart.monthly-chart');
        Route::get('/chart-data-course', [ChartController::class, 'monthlycourse']);
        Route::get('/chart-data-college', [ChartController::class, 'monthlycollege']);

        Route::view('/student-weekly-chart', 'admin.chart.weekly-chart');
        Route::get('/chart-data-course-week', [ChartController::class, 'weeklycourse']);
        Route::get('/chart-data-college-week', [ChartController::class, 'weeklycollege']);

    });




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



  // student
    // Route::get('/student-list', [StudentController::class, 'list'])->name('student.list');
    // Route::get('/add-student-form',[StudentController::class, 'create'])->name('student.create');

    // Route::post('/add-student', [StudentController::class, 'store'])->name('student.store');
    // Route::get('edit/{student_id}', [StudentController::class, 'edit']);
    // Route::patch('/update-student/{student_id}', [StudentController::class, 'update'])->name('student.update');
    // Route::get('delete/{id}', [StudentController::class, 'delete_student']);


     // faculty and staff
    // Route::get('/faculty-create', [FacultyController::class, 'create'])->name('faculty.create');
    // Route::post('/faculty-store', [FacultyController::class, 'store'])->name('faculty.store');
    // Route::get('edit-faculty/{id}', [FacultyController::class, 'edit_faculty']);
    // Route::patch('/update-faculty/{faculty_id}', [FacultyController::class, 'update'])->name('faculty.update');
    // Route::get('delete-faculty/{id}', [FacultyController::class, 'delete_faculty']);


     // reports of student records
    // Route::view('College of Information and Computing Sciences', 'admin.student.reports-pdf');
