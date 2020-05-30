<?php

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

// general auth
Route::post('logout', function () {
    Session::flush();
    return redirect('/');
})->name('logout');

// portal
Route::get('/', 'PageController@getHome');


//login register akun
Route::get('login-welcome', 'PageController@showWelcomeLogin');

Route::get('login-er', 'EmployerController@showLogin')->name('employer.showLogin');
Route::post('login-er', 'EmployerController@Login')->name('employer.login');

Route::get('register-er', 'EmployerController@showRegister')->name('employer.showRegister');
Route::post('register-er', 'EmployerController@Register')->name('employer.register');

Route::get('login-st', 'StudentController@showLogin')->name('student.showLogin');
Route::post('login-st', 'StudentController@Login')->name('student.login');

Route::get('register-st', 'StudentController@showRegister')->name('student.showRegister');
Route::post('register-st', 'StudentController@Register')->name('student.register');

Route::get('login-gs', 'GuestController@showLogin')->name('guest.showLogin');
Route::post('login-gs', 'GuestController@Login')->name('guest.login');

Route::get('register-gs', 'GuestController@showRegister')->name('guest.showRegister');
Route::post('register-gs', 'GuestController@Register')->name('guest.register');

// Route::get('login-warning-test', 'PageController@showLoginWarning');


// admin
Route::get('adminsuperscretloginY', 'AdminController@showLogin')->name('admin.showlogin');
Route::post('adminsuperscretloginY', 'AdminController@Login')->name('admin.login');

Route::get('admin-login', 'AdminController@showLogin')->name('admin.showlogin');
Route::post('adminsuperscretloginY', 'AdminController@Login')->name('admin.login');

Route::get('/jobs', 'JobController@index');


// dashboard
Route::get('dashboard', 'DashboardController@getHome')->middleware('LoginCheck');

Route::get('adminsuperscretregisterY', 'AdminController@showRegister')->name('admin.showregister');
Route::post('adminsuperscretregisterY', 'AdminController@Register')->name('admin.register');

Route::group(['middleware' => 'LoginCheck', 'EmployerCheck'], function(){
    Route::get('dashboard/er/create-job', 'DashboardEmployerController@getCreateJob');
    Route::post('dashboard/er/create-job', 'DashboardEmployerController@postCreateJob')->name('dashboard.employer.createJob');

    Route::get('dashboard/er/job-approval', 'DashboardEmployerController@getJobsApproval');
    Route::get('dashboard/er/job-applicant-pending', 'DashboardEmployerController@getJobsApplicantPending');
    Route::get('dashboard/er/job-applicant-accepted', 'DashboardEmployerController@getJobsApplicantAccepted');

    Route::get('dashboard/er/create-seminar', 'DashboardEmployerController@getCreateSeminar');
    Route::post('dashboard/er/create-seminar', 'DashboardEmployerController@postCreateSeminar')->name('dashboard.employer.createSeminar');

    Route::get('dashboard/er/seminar-approval', 'DashboardEmployerController@getSeminarsApproval');
});

Route::group(['middleware' => 'LoginCheck', 'AdminCheck'], function(){
    Route::get('admin/user-list', 'DashboardController@getUserList');

    Route::get('admin/new-employers', 'DashboardController@getNewEmployers');
    Route::get('admin/approved-employers', 'DashboardController@getAprrovedEmployers');
    Route::get('admin/unapproved-employers', 'DashboardController@getUnapprovedEmployers');

    Route::get('admin/new-jobs', 'DashboardController@getNewJobs');
    Route::get('admin/approved-jobs', 'DashboardController@getApprovedJobs');
    Route::get('admin/unapproved-jobs', 'DashboardController@getUnapprovedJobs');
    
    Route::get('admin/new-seminars', 'DashboardController@getNewSeminars');
    Route::get('admin/approved-seminars', 'DashboardController@getApprovedSeminars');
    Route::get('admin/unapproved-seminars', 'DashboardController@getUnapprovedSeminars');
});


