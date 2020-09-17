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

Route::get('its-youth-technopreneur', 'PageController@getIYT');


//login register akun
Route::get('login-welcome', 'PageController@showWelcomeLogin')->name('login-welcome');

Route::get('login-er', 'EmployerController@showLogin')->name('employer.showLogin')->middleware('LoginTrue');
Route::post('login-er', 'EmployerController@Login')->name('employer.login')->middleware('LoginTrue');

Route::get('register-er', 'EmployerController@showRegister')->name('employer.showRegister');
Route::post('register-er', 'EmployerController@Register')->name('employer.register');

Route::get('login-st', 'StudentController@showLogin')->name('student.showLogin')->middleware('LoginTrue');;
Route::post('login-st', 'StudentController@Login')->name('student.login')->middleware('LoginTrue');;

Route::get('register-st', 'StudentController@showRegister')->name('student.showRegister');
Route::post('register-st', 'StudentController@Register')->name('student.register');

Route::get('login-gs', 'GuestController@showLogin')->name('guest.showLogin')->middleware('LoginTrue');;
Route::post('login-gs', 'GuestController@Login')->name('guest.login')->middleware('LoginTrue');;

Route::get('register-gs', 'GuestController@showRegister')->name('guest.showRegister');
Route::post('register-gs', 'GuestController@Register')->name('guest.register');

Route::get('syarat-ketentuan', 'PageController@showSK');

Route::get('mentor/login', 'MentorController@viewLogin')->name('mentor.viewLogin');
Route::post('mentor/login', 'MentorController@Login')->name('mentor.login');

Route::get('mentor/register', 'MentorController@viewRegister')->name('mentor.viewRegister');
Route::post('mentor/register', 'MentorController@Register')->name('mentor.register');
// Route::get('login-warning-test', 'PageController@showLoginWarning');


// admin
Route::get('admin/login', 'AdminController@showLogin')->name('admin.showlogin');
Route::post('adminsuperscretloginY', 'AdminController@Login')->name('admin.login');
Route::get('admin/register', 'AdminController@showRegister')->name('admin.showregister');
Route::post('adminsuperscretregisterY', 'AdminController@Register')->name('admin.register');

Route::get('admin-login', 'AdminController@showLogin')->name('admin.showlogin');
Route::post('adminsuperscretloginY', 'AdminController@Login')->name('admin.login');

Route::get('/download-proposal-project/{proposal}', 'DashboardController@downloadproposalproj')->name('proposal.project.investasi.download');
Route::get('/download-laporan-project/{laporan}', 'DashboardController@downloadlaporanproj')->name('laporan.project.investasi.download');

Route::get('/download-proposal-funding/{proposal}', 'DashboardController@downloadproposalfund')->name('proposal.funding.investasi.download');
Route::get('/download-laporan-funding/{laporan}', 'DashboardController@downloadlaporanfund')->name('laporan.funding.investasi.download');

//student
Route::get('/download-berkas-student/{berkas}', 'DashboardController@downloadBerkasStudent')->name('berkas.student.download');
// jobs

Route::get('/jobs', 'JobController@index')->name('jobs');
Route::get('/jobs/category/{slug}', 'JobController@filterCategory')->name('job.filter');
Route::get('/jobs/{id}', 'JobController@detail');
Route::get('/download-berkas-employer/{berkas}', 'EmployerController@downloadBerkas')->name('berkas.employer.download');
Route::get('/download-cv/{cv}', 'JobController@downloadCV')->name('cv.download');
Route::post('/search', 'PageController@search')->name('search');

Route::get('/seminar', 'SeminarController@index')->name('seminar');
Route::get('/seminar/category/{slug}', 'SeminarController@filterCategory')->name('seminar.filter');
Route::get('/seminar/{id}', 'SeminarController@detail');
//guest
Route::get('/download-berkas/{berkas}', 'GuestController@downloadBerkas')->name('berkas.download');

// jasa
Route::get('/jasa', 'ServicesController@index');
Route::get('/jasa/category/{slug}', 'ServicesController@filterServicesCategory');
Route::get('/jasa/{slug}', 'ServicesController@detailServices');

//employer
Route::get('/download-order-form','PageController@downloadFormOrder')->name('download.form-order');
Route::get('/download-order-form-employer/{form}','DashboardController@downloadFormEmployer')->name('form-order.employer.download');

//Seminar
Route::get('/download-bukti-sewa-tempat/{seminar}', 'DashboardEmployerController@downloadBerkasBuktiSewa')->name('berkas.seminar.download');
Route::get('/download-profil-pembicara/{seminar}', 'DashboardEmployerController@downloadProfilPembicara')->name('berkas.profil.download');
Route::get('/download-poster/{seminar}', 'DashboardEmployerController@downloadPoster')->name('berkas.poster.download');

//iyt
Route::get('/download-proposal-bisnis-iyt/{prop}', 'DashboardController@downloadProposalBisnis')->name('iyt.proposalbisnis.download');
Route::get('/download-pitch-desk-iyt/{prop}', 'DashboardController@downloadPitchDesk')->name('iyt.pitchdesk.download');

// investasi
Route::get('/investasi-project', 'InvestasiController@showProjectIndex');
Route::get('/investasi-project/{id}', 'InvestasiController@detailProject');
Route::post('/beli-saham/{id}', 'InvestasiController@beliSaham')->name('saham-beli')->middleware('GuestStudentCheck');

Route::get('investasi-fund', 'InvestasiController@showFundIndex');
Route::get('investasi-fund/{id}', 'InvestasiController@detailFund');
Route::post('donasi/{id}', 'InvestasiController@donasi')->middleware('GuestStudentCheck');

//route midtrans
Route::get('payment/finish', 'PageController@paymentFinish');
Route::get('payment/unfinish', 'PageController@paymentUnfinish');
Route::get('payment/error', 'PageController@paymentError');
Route::post('notification/midtrans', 'InvestasiController@notificationHandler');

Route::get('orders/received/{order_id}', 'PageController@receivedOrder')->middleware('LoginCheck');

Route::get('/investasi-fund', 'InvestasiController@showFundIndex');
Route::get('/investasi-fund/{id}', 'InvestasiController@detailFund');
Route::post('/donasi/{id}', 'InvestasiController@donasi');

// dashboard
Route::get('dashboard', 'DashboardController@getHome')->middleware('LoginCheck');


Route::group(['middleware' => 'LoginCheck', 'GuestCheck'], function(){

    Route::get('dashboard/gs/list-jasa', 'DashboardGuestController@getListJasa');
    Route::get('dashboard/gs/list-jasa-rejected', 'DashboardGuestController@getListJasaRejected');
    Route::get('dashboard/gs/list-jasa-done', 'DashboardGuestController@getListJasaDone');
    Route::get('dashboard/gs/list-jasa-inprogress', 'DashboardGuestController@getListJasaInprogress');
    Route::post('/applyservices/{id}', 'ServicesController@approach');
    Route::put('dashboard/gs/service-applicant/done/{guest}', 'DashboardGuestController@doneServices')->name('service.done');
    Route::put('dashboard/gs/service-applicant/notdone/{guest}', 'DashboardGuestController@notdoneServices')->name('service.notdone');

    // order list
    Route::get('dashboard/gs/orders', 'DashboardGuestController@getOrderList');

    Route::get('dashboard/gs/on-going-project-list', 'DashboardGuestController@showProjectListStudent');
    Route::get('dashboard/gs/download-progress/{berkas}', 'DashboardInvesteeController@downloadberkasprogres')->name('dashboard.guest.download-progress');
    Route::get('dashboard/gs/detail-investment/{id}', 'DashboardGuestController@showDetailInvestment')->name('dashboard.guest.getDetailInvestment');
});



Route::group(['middleware' => 'LoginCheck', 'StudentCheck'], function() {
    Route::get('dashboard/st/create-service', 'DashboardStudentController@getCreateService');
    Route::post('dashboard/st/create-service', 'DashboardStudentController@postCreateService')->name('dashboard.student.createService');

    Route::get('dashboard/st/service-approval', 'DashboardStudentController@getServicesApproval');
    Route::get('dashboard/st/service-applicant-pending', 'DashboardStudentController@getServicesApplicantPending');
    Route::get('dashboard/st/service-applicant-accepted', 'DashboardStudentController@getServicesApplicantAccepted');
    Route::put('dashboard/st/service-applicant/a/{guest}', 'DashboardStudentController@acceptNewApplicants')->name('service-applicant.accept');
    Route::put('dashboard/st/service-applicant/d/{guest}', 'DashboardStudentController@rejectNewApplicants')->name('service-applicant.reject');
    // Route::put('dashboard/st/service-applicant/done/{guest}', 'DashboardStudentController@doneServices')->name('service.done');
    // Route::put('dashboard/st/service-applicant/notdone/{guest}', 'DashboardStudentController@notdoneServices')->name('service.notdone');
    Route::get('dashboard/st/invest-return-approval', 'DashboardStudentController@InvestReturnApproval');
    Route::put('dashboard/st/invest-return/a/{id}', 'DashboardStudentController@approveInvestReturn')->name('invest-return.confirm');

    Route::get('dashboard/st/job-approval', 'DashboardStudentController@getJobsApproval');
    Route::post('/applyjob/{id}', 'JobController@apply');

    Route::get('dashboard/st/profile', 'DashboardStudentController@getProfilePage');
    Route::get('dashboard/st/profile/edit', 'DashboardStudentController@editProfilePage');
    Route::put('dashboard/st/profile/update', 'DashboardStudentController@updateProfilePage')->name('student.profile.update');

    Route::get('dashboard/register-investee', 'DashboardInvesteeController@showRegister');
    Route::post('dashboard/register-investee', 'DashboardInvesteeController@registerNew')->name('post-register-investee');
    Route::get('dashboard/register-status', 'DashboardInvesteeController@getRegisterStatus');
    Route::get('dashboard/register-IYT', 'DashboardIYTController@getCreateIYT');
    Route::post('dashboard/register-IYT', 'DashboardIYTController@postCreateIYT')->name('post-register-iyt');
    Route::get('dashboard/register-IYT-status', 'DashboardIYTController@getRegisterIYTStatus');

    // order list
    Route::get('dashboard/st/orders', 'DashboardGuestController@getOrderList');

    Route::get('dashboard/st/on-going-project-list', 'DashboardStudentController@showProjectListStudent');
    Route::get('dashboard/st/download-progress/{berkas}', 'DashboardInvesteeController@downloadberkasprogres')->name('dashboard.student.download-progress');
    Route::get('dashboard/st/detail-investment/{id}', 'DashboardStudentController@showDetailInvestment')->name('dashboard.getDetailInvestment');
    // investee
    Route::get('dashboard/investee', 'DashboardController@getInvestee')->middleware('InvesteeCheck');
    Route::get('dashboard/investee/create-project-investment', 'DashboardInvesteeController@getCreateProjInvestment')->middleware('InvesteeCheck')->name('dashboard.investee.getCreateProjectInvestment');
    Route::post('dashboard/investee/post-project-investment', 'DashboardInvesteeController@postCreateProjInvestment')->middleware('InvesteeCheck')->name('dashboard.investee.createProjectInvestment');
    Route::get('dashboard/investee/create-funding-investment', 'DashboardInvesteeController@getCreateFundInvestment')->middleware('InvesteeCheck')->name('dashboard.investee.getCreateFundingInvestment');
    Route::post('dashboard/investee/post-funding-investment', 'DashboardInvesteeController@postCreateFundInvestment')->middleware('InvesteeCheck')->name('dashboard.investee.createFundingInvestment');
    Route::get('dashboard/investee/investment-project-list', 'DashboardInvesteeController@showProjectInvestee')->middleware('InvesteeCheck')->name('dashboard.investee.getProjectInvestee');
    Route::get('dashboard/investee/detail-investment/{id}', 'DashboardInvesteeController@showDetailInvestment')->middleware('InvesteeCheck')->name('dashboard.investee.getDetailInvestment');
    Route::post('dashboard/investee/upload-progress/{id}', 'DashboardInvesteeController@submitprogress')->middleware('InvesteeCheck')->name('dashboard.investee.upload-progress');
    Route::get('dashboard/investee/download-progress/{berkas}', 'DashboardInvesteeController@downloadberkasprogres')->middleware('InvesteeCheck')->name('dashboard.investee.download-progress');
    Route::get('dashboard/investee/dummy', 'DashboardController@getInvestee')->middleware('InvesteeCheck');

    Route::get('dashboard/IYT', 'DashboardIYTController@getHomeIYT')->middleware('IYTCheck');
});

Route::group(['middleware' => 'LoginCheck', 'StudentCheck', 'IYTCheck'], function(){

    Route::get('dashboard/IYT/submit-laporan-bulanan', 'DashboardIYTController@getSubmitLaporanBulanan');
    Route::post('dashboard/IYT/submit-laporan-bulanan', 'DashboardIYTController@postSubmitLaporanBulanan')->name('dashboard.iyt.submit-laporan-bulanan');
    Route::get('dashboard/IYT/notulensi', 'IytMentoringController@showIYTNotulensi');
});

// Route::get('submit-laporan-bulanan', 'DashboardIYTController@getSubmitLaporanBulanan');
// Route::post('dashboard/IYT/submit-laporan-bulanan', 'DashboardIYTController@postSubmitLaporanBulanan')->name('dashboard.iyt.submit-laporan-bulanan');
Route::get('submit-kontrol-bulanan', 'DashboardIYTController@getSubmitKontrolBulanan');
Route::post('submit-laporan-bulanan', 'DashboardIYTController@postSubmitKontrolBulanan')->name('dashboard.iyt.submit-kontrol-bulanan');

Route::get('submit-laporan-kemajuan', 'DashboardIYTController@getSubmitLaporanKemajuan');
Route::post('submit-laporan-kemajuan', 'DashboardIYTController@postSubmitLaporanKemajuan')->name('dashboard.iyt.submit-laporan-kemajuan');


Route::group(['middleware' => 'LoginCheck', 'EmployerCheck'], function(){
    Route::get('dashboard/er/create-job', 'DashboardEmployerController@getCreateJob');
    Route::post('dashboard/er/create-job', 'DashboardEmployerController@postCreateJob')->name('dashboard.employer.createJob');

    Route::get('dashboard/er/job-approval', 'DashboardEmployerController@getJobsApproval');
    Route::get('dashboard/er/job-applicant-pending', 'DashboardEmployerController@getJobsApplicantPending');
    Route::get('dashboard/er/job-applicant-accepted', 'DashboardEmployerController@getJobsApplicantAccepted');
    Route::put('dashboard/er/job-applicant/a/{student}', 'DashboardEmployerController@acceptNewApplicants')->name('job-applicant.accept');
    Route::put('dashboard/er/job-applicant/d/{student}', 'DashboardEmployerController@rejectNewApplicants')->name('job-applicant.reject');

    Route::get('dashboard/er/create-seminar', 'DashboardEmployerController@getCreateSeminar');
    Route::post('dashboard/er/create-seminar', 'DashboardEmployerController@postCreateSeminar')->name('dashboard.employer.createSeminar');

    Route::get('dashboard/er/seminar-approval', 'DashboardEmployerController@getSeminarsApproval');

    Route::get('dashboard/er/profile', 'DashboardEmployerController@getProfilePage');
    Route::get('dashboard/er/profile/edit', 'DashboardEmployerController@editProfilePage');
    Route::put('dashboard/er/profile/update', 'DashboardEmployerController@updateProfilePage')->name('employer.profile.update');

    Route::get('dashboard/er/create-investation', 'DashboardEmployerController@getCreateInvestation');
    Route::post('dashboard/er/create-investation', 'DashboardEmployerController@postCreateInvestation')->name('dashboard.employer.createInvestation');
    Route::get('dashboard/er/investations-approval', 'DashboardEmployerController@getInvestationsApproval');
    Route::get('dashboard/er/investor-confirmation', 'DashboardEmployerController@getPaidInvestor');
    Route::put('dashboard/er/investor-confirmation/a/{id}', 'DashboardEmployerController@confirmPaidInvestor')->name('investor.paid.approve');

    Route::get('dashboard/er/investation-due-payments', 'DashboardEmployerController@getDueInvestation');
    Route::get('dashboard/er/investation-due-payments/investasi/{id}', 'DashboardEmployerController@getDueInvestationInvestor');
    Route::put('dashboard/er/investation-due-payments/investasi/save/{isid}', 'DashboardEmployerController@saveBuktiPembayaran')->name('investationDuePaymentsSave');
});

Route::group(['middleware' => 'LoginCheck', 'AdminCheck'], function(){
    Route::get('admin/new-students', 'DashboardController@getNewStudents');
    Route::get('admin/approved-students', 'DashboardController@getApprovedStudents');
    Route::get('admin/unapproved-students', 'DashboardController@getUnapprovedStudents');
    Route::put('admin/new-students/a/{student}', 'DashboardController@approveNewStudents')->name('student.approve');
    Route::put('admin/new-students/d/{student}', 'DashboardController@rejectNewStudents')->name('student.reject');

    Route::get('admin/new-investees', 'DashboardController@getNewInvestees');
    Route::get('admin/approved-investees', 'DashboardController@getApprovedInvestees');
    Route::get('admin/unapproved-investees', 'DashboardController@getUnapprovedInvestees');
    Route::put('admin/new-investees/a/{investee}', 'DashboardController@approveNewInvestees')->name('investee.approve');
    Route::put('admin/new-investees/d/{investee}', 'DashboardController@rejectNewInvestees')->name('investee.reject');

    Route::get('admin/new-services', 'DashboardController@getNewServices');
    Route::get('admin/approved-services', 'DashboardController@getApprovedServices');
    Route::get('admin/unapproved-services', 'DashboardController@getUnapprovedServices');
    Route::put('admin/new-services/a/{service}', 'DashboardController@approveNewServices')->name('service.approve');
    Route::put('admin/new-services/d/{service}', 'DashboardController@rejectNewServices')->name('service.reject');

    Route::get('admin/new-guests', 'DashboardController@getNewGuests');
    Route::get('admin/unapproved-guests', 'DashboardController@getUnapprovedGuests');
    Route::get('admin/approved-guests', 'DashboardController@getApprovedGuests');
    Route::put('admin/new-guests/a/{post}', 'DashboardController@approveNewGuests')->name('guest.approve');
    Route::put('admin/new-guests/r/{post}', 'DashboardController@rejectNewGuests')->name('guest.reject');
    Route::delete('admin/new-guests/d/{employer}', 'DashboardController@deleteGuests')->name('guest.delete');

    Route::get('admin/new-employers', 'DashboardController@getNewEmployers');
    Route::get('admin/approved-employers', 'DashboardController@getAprrovedEmployers');
    Route::get('admin/unapproved-employers', 'DashboardController@getUnapprovedEmployers');
    Route::put('admin/new-employers/a/{post}', 'DashboardController@approveNewEmployers')->name('employer.approve');
    Route::put('admin/new-employers/d/{post}', 'DashboardController@rejectNewEmployers')->name('employer.reject');
    Route::delete('admin/delete-em/{employer}', 'DashboardController@deleteEmployer')->name('employer.delete');

    Route::get('admin/new-jobs', 'DashboardController@getNewJobs');
    Route::get('admin/approved-jobs', 'DashboardController@getApprovedJobs');
    Route::get('admin/unapproved-jobs', 'DashboardController@getUnapprovedJobs');
    Route::put('admin/new-jobs/a/{job}', 'DashboardController@approveNewJobs')->name('job.approve');
    Route::put('admin/new-jobs/d/{job}', 'DashboardController@rejectNewJobs')->name('job.reject');

    Route::get('admin/new-seminars', 'DashboardController@getNewSeminars');
    Route::get('admin/approved-seminars', 'DashboardController@getApprovedSeminars');
    Route::get('admin/unapproved-seminars', 'DashboardController@getUnapprovedSeminars');
    Route::put('admin/new-seminars/a/{seminar}', 'DashboardController@approveNewSeminars')->name('seminar.approve');
    Route::put('admin/new-seminars/d/{seminar}', 'DashboardController@rejectNewSeminars')->name('seminar.reject');

    Route::get('admin/new-project-investment', 'DashboardController@getNewProjInvestment');
    Route::get('admin/approved-project-investment', 'DashboardController@getApprovedProjInvestment');
    Route::get('admin/unapproved-project-investment', 'DashboardController@getUnapprovedProjInvestment');
    Route::put('admin/new-project-investment/a/{projinvestment}', 'DashboardController@approveNewProjInvestment')->name('project.investment.approve');
    Route::put('admin/new-project-investment/d/{projinvestment}', 'DashboardController@rejectNewProjInvestment')->name('project.investment.reject');

    Route::get('admin/new-funding-investment', 'DashboardController@getNewFundInvestment');
    Route::get('admin/approved-funding-investment', 'DashboardController@getApprovedFundInvestment');
    Route::get('admin/unapproved-funding-investment', 'DashboardController@getUnapprovedFundInvestment');
    Route::put('admin/new-funding-investment/a/{fundinvestment}', 'DashboardController@approveNewFundInvestment')->name('funding.investment.approve');
    Route::put('admin/new-funding-investment/d/{fundinvestment}', 'DashboardController@rejectNewFundInvestment')->name('funding.investment.reject');

    Route::get('admin/IYT-List-all', 'DashboardController@getListAllIYT');
    Route::get('admin/IYT-Qualify', 'DashboardController@getListQualifyIYT');
    Route::get('admin/list-batches', 'DashboardController@getListBatches');
    Route::put('admin/new-batch/a/{id}', 'DashboardController@changeToActive')->name('batch.active');
    Route::put('admin/new-batch/d/{id}', 'DashboardController@changeToNonActive')->name('batch.non-active');
    Route::put('admin/IYT-List-all/a/{iyt}', 'DashboardController@approveIYT')->name('iyt.approve');
    Route::put('admin/IYT-List-all/d/{iyt}', 'DashboardController@rejectIYT')->name('iyt.reject');
    Route::get('admin/IYT-create-batch','DashboardController@viewCreateIYTBatch');
    Route::post('admin/IYT-create-batch','DashboardController@createIYTBatch')->name('iyt.createBatch');
});



Route::group(['middleware' => 'LoginCheck', 'MentorCheck'], function(){
    Route::get('mentor/IYT-create-mentoring','IytMentoringController@showCreateMentoring');
    Route::post('mentor/IYT-create-mentoring','IytMentoringController@createMentoring')->name('iyt.createMentoring');
    Route::put('mentor/IYT-comment/{id}','IytMentoringController@postComment')->name('iyt.postComment');
    Route::put('mentor/IYT-edit-comment/{id}','IytMentoringController@editComment')->name('iyt.editComment');
    Route::get('mentor/IYT-mentoring','DashboardController@viewCreateIYTBatch');
    Route::get('mentor/list-peserta-IYT','IytMentoringController@showListPeserta');
    Route::get('mentor/list-peserta-IYT/detail/{id}', 'IytMentoringController@showDetailPeserta')->name('mentor.detail-peserta');
    Route::get('/download-dokumentasi-mentoring/{idmentoring}', 'IytMentoringController@downloadDokumentasi')->name('iyt.mentoring.download.dokumentasi');
    Route::put('/upload-dokumentasi-mentoring/{idmentoring}', 'IytMentoringController@uploadDokumentasi')->name('iyt.mentoring.upload.dokumentasi');


});
