<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'index')->name('home');

Route::get('/api/user', 'UserController@show');

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'users.admin.dashboard')->name('admin-dashboard');

    Route::resources([
        '/departments' => 'DepartmentController',
        '/doctors' => 'DoctorController',
        '/patients' => 'PatientController',
        '/nurses' => 'NurseController',
        '/accountants' => 'AccountantController',
        '/pharmacists' => 'PharmacistController',
        '/receptionists' => 'ReceptionistController',
        '/laboratorists' => 'LaboratoristController',
        '/timeschedules' => 'TimeScheduleController',
        '/casehistories' => 'CaseHistoryController',
        '/appointments' => 'AppointmentController',
        '/documents' => 'DocumentController',
        '/prescriptions' => 'PrescriptionController',
        '/medicines/categories' => 'MedicineCategoryController',
        '/medicines' => 'MedicineController',
        '/services' => 'ServiceController',
        '/beds' => 'BedController',
        '/lapreports' => 'LapReportController',
        '/laptemplates' => 'LapTemplateController',
        '/bedallotments' => 'BedAllotmentController',
        '/servicepackages' => 'ServicePackageController',
        '/dayoffschedules' => 'DayoffScheduleController',
        '/payments' => 'PaymentController',
        '/paymentitems' => 'PaymentItemController',
        '/expenses' => 'ExpenseController',
    ]);

    Route::get('/treatmenthistory/{doctor}', 'DoctorController@treatmentHistory')->name('treatment-history');
    Route::get('/timeschedule/{doctor}', 'TimeScheduleController@timeSchedulesForDoctor')->name('doctor-time-schedules');
    Route::get('/timeschedule/{doctor}/create/', 'TimeScheduleController@createtimeScheduleForDoctor')->name('create-time-schedule-for-doctor');

    Route::name('get-')->group(function () {
        Route::get('doctorsbydepartment', 'AppointmentController@getDoctorsByDepartment')->name('doctors-by-department');
        Route::get('timeschedulebydoctor', 'DoctorController@getTimeScheduleByDoctor')->name('time-schedule-by-doctor');
        Route::get('dayoffschedulebydoctor', 'DoctorController@getDayoffScheduleByDoctor')->name('dayoff-schedule-by-doctor');
        Route::get('timebytimeschedule', 'TimeScheduleController@getTimeByTimeSchedule')->name('time-by-time-schedule');
        Route::get('appointmentsbydate', 'AppointmentController@getAppointmentsByDate')->name('appointments-by-date');
        Route::get('bedallotmentsbydate', 'BedAllotmentController@getBedAllotmentsByDate')->name('bedallotments-by-date');
        Route::get('templatebyid', 'LapReportController@getTemplateById')->name('template-by-id');
        Route::get('paymentitembyitemid', 'PaymentItemController@getPaymentItemByItemId')->name('payment-item-by-item-id');
        Route::get('paymentitembydoctorid', 'PaymentItemController@getPaymentItemByDoctorId')->name('payment-item-by-doctor-id');
        Route::get('userbyusertype', 'PublicController@getUserByUserType')->name('user-by-user-type');
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
