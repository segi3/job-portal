<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Student;
use App\Job;
use App\Employer;
use App\Guest;
use App\Seminar;
use App\Service;
use App\Investasi;


class DashboardController extends Controller
{
    public function getHome(Request $request) {

        if ($request->session()->get('role') == 'admin') {
            return view('dashboard.pages.admins.home');
        } elseif ($request->session()->get('role') == 'employer') {
            return view('dashboard.pages.employer.home');
        } elseif ($request->session()->get('role') == 'student') {
            return view('dashboard.pages.student.home');
        } else if ($request->session()->get('role') == 'guest') {
            return view ('dashboard.pages.guest.home');
        }
        return view('/');
    }

    // manage users admin
    public function getUserList()
    {

        $students = Student::select('name', 'nrp', 'email')->paginate(20);

        return view ('dashboard.pages.admins.userlist')->with('students', $students);
    }

    public function getNewServices()
    {

        $services = Service::where('services.status', '0')
                    ->leftjoin('students', 'students.id', 'services.student_id')
                    ->leftjoin('job_categories', 'job_categories.id', 'services.job_category_id')
                    ->select('services.*', 'students.name as stdname', 'job_categories.name as category_name')
                    ->paginate(20);


        return view('dashboard.pages.admins.newservices')->with('services', $services);
    }

    public function getApprovedServices()
    {
        $services = Service::where('status', '1')
                    ->leftjoin('students', 'students.id', 'services.student_id')
                    ->leftjoin('job_categories', 'job_categories.id', 'services.job_category_id')
                    ->select('services.*', 'students.name as stdname', 'job_categories.name as category_name')
                    ->paginate(20);

        return view('dashboard.pages.admins.approvedservices')->with('services', $services);
    }

    public function getUnapprovedServices()
    {
        $services = Service::where('status', '2')
                    ->leftjoin('students', 'students.id', 'services.student_id')
                    ->leftjoin('job_categories', 'job_categories.id', 'services.job_category_id')
                    ->select('services.*', 'students.name as stdname', 'job_categories.name as category_name')
                    ->paginate(20);

        return view('dashboard.pages.admins.unapprovedservices')->with('services', $services);
    }

    public function approveNewServices(Request $request, $id)
    {
        $service = Service::find($id);

        $service->status = 1;
        $service->admin_id = $request->session()->get('id');

        $service->save();

        return redirect()->back();
    }

    public function rejectNewServices(Request $request, $id)
    {
        $service = Service::find($id);

        $service->status = 2;
        $service->admin_id = $request->session()->get('id');

        $service->save();

        return redirect()->back();
    }

    //manage employers guest
    public function getNewGuests()
    {

        $guests = Guest::where('status_gs', '0')->paginate(20);

        return view ('dashboard.pages.admins.newguests')->with('guests', $guests);
    }
    public function getApprovedGuests()
    {

        $guests = Guest::where('status_gs', '1')->paginate(20);

        return view ('dashboard.pages.admins.approvedguests')->with('guests', $guests);
    }
    public function getUnapprovedGuests()
    {

        $guests = Guest::where('status_gs', '2')->paginate(20);

        return view ('dashboard.pages.admins.unapprovedguests')->with('guests', $guests);
    }
    public function approveNewGuests(Request $request, $id)
    {
        $guest = Guest::find($id);

        $guest->status_gs = 1;
        // $guest->admin_id = $request->session()->get('id');

        $guest->save();

        return redirect()->back();
    }

    public function rejectNewGuests(Request $request, $id)
    {
        $guest = Guest::find($id);

        $guest->status_gs = 2;
        // $guest->admin_id = $request->session()->get('id');

        $guest->save();

        return redirect()->back();
    }
    public function deleteGuests($id)
    {
        $guest = Guest::find($id);

        $guest->delete();

        return redirect()->back();
    }

    //manage employers admin
    public function getNewEmployers()
    {

        $employers = Employer::where('status', '0')->paginate(20);

        return view ('dashboard.pages.admins.newemployers')->with('employers', $employers);
    }

    public function approveNewEmployers(Request $request, $id)
    {
        $employer = Employer::find($id);

        $employer->status = 1;
        $employer->admin_id = $request->session()->get('id');

        $employer->save();

        return redirect()->back();
    }

    public function rejectNewEmployers(Request $request, $id)
    {
        $employer = Employer::find($id);

        $employer->status = 2;
        $employer->admin_id = $request->session()->get('id');

        $employer->save();

        return redirect()->back();
    }

    public function deleteEmployer($id)
    {
        $employer = Employer::find($id);

        $employer->delete();

        return redirect()->back();
    }

    public function getAprrovedEmployers() {

        $employers = Employer::where('status', '1')->paginate(20);

        return view ('dashboard.pages.admins.approvedemployers')->with('employers', $employers);
    }

    public function getUnapprovedEmployers() {

        $employers = Employer::where('status', '2')->paginate(20);

        return view ('dashboard.pages.admins.unapprovedemployers')->with('employers', $employers);
    }

    // manage jobs admin
    public function getNewJobs() {

        $jobs = Job::where('jobs.status', '0')
                ->leftjoin('employers', 'employers.id', 'employer_id')
                ->leftjoin('job_categories', 'job_categories.id', 'job_category_id')
                ->select('jobs.*', 'employers.name as employer_name', 'job_categories.name as category_name')
                ->paginate(20);

        return view ('dashboard.pages.admins.newjobs')->with('jobs', $jobs);
    }

    public function approveNewJobs(Request $request, $id)
    {
        $job = Job::find($id);

        $job->status = 1;
        $job->admin_id = $request->session()->get('id');

        $job->save();

        return redirect()->back();
    }

    public function rejectNewJobs(Request $request, $id)
    {
        $job = Job::find($id);

        $job->status = 2;
        $job->admin_id = $request->session()->get('id');

        $job->save();

        return redirect()->back();
    }



    public function getApprovedJobs() {

        $jobs = Job::where('jobs.status', '1')
                ->leftjoin('employers', 'employers.id', 'employer_id')
                ->leftjoin('job_categories', 'job_categories.id', 'job_category_id')
                ->select('jobs.*', 'employers.name as employer_name', 'job_categories.name as category_name')
                ->paginate(20);

        return view ('dashboard.pages.admins.approvedjobs')->with('jobs', $jobs);
    }
    public function getUnapprovedJobs() {

        $jobs = Job::where('jobs.status', '2')
        ->leftjoin('employers', 'employers.id', 'employer_id')
        ->leftjoin('job_categories', 'job_categories.id', 'job_category_id')
        ->select('jobs.*', 'employers.name as employer_name', 'job_categories.name as category_name')
        ->paginate(20);


        return view ('dashboard.pages.admins.unapprovedjobs')->with('jobs', $jobs);
    }

    // manage jobs admin
    public function getNewSeminars() {

        $seminars = Seminar::where('status', '0')->paginate(20);

        return view ('dashboard.pages.admins.newseminars')->with('seminars', $seminars);
    }

    public function approveNewSeminars(Request $request, $id)
    {
        $seminar = Seminar::find($id);

        $seminar->status = 1;
        $seminar->admin_id = $request->session()->get('id');

        $seminar->save();

        return redirect()->back();
    }

    public function rejectNewSeminars(Request $request, $id)
    {
        $seminar = Seminar::find($id);

        $seminar->status = 2;
        $seminar->admin_id = $request->session()->get('id');

        $seminar->save();

        return redirect()->back();
    }

    public function getApprovedSeminars() {

        $seminars = Seminar::where('status', '1')->paginate(20);

        return view ('dashboard.pages.admins.approvedseminars')->with('seminars', $seminars);
    }
    public function getUnapprovedSeminars() {

        $seminars = Seminar::where('status', '2')->paginate(20);

        return view ('dashboard.pages.admins.unapprovedseminars')->with('seminars', $seminars);
    }

    public function getNewInvestment() {

        $investasi = Investasi::where('investasi.status', '0')
                ->leftjoin('employers', 'employers.id', 'employer_id')
                ->select('investasi.*', 'employers.name as employername', 'employers.contact_person as cp')
                ->paginate(20);

        return view('dashboard.pages.admins.newinvestment')->with('investasi', $investasi);
    }

    public function approveNewInvestment(Request $request, $id)
    {
        $investasi = Investasi::find($id);

        $investasi->status = 1;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }

    public function rejectNewInvestment(Request $request, $id)
    {
        $investasi = Investasi::find($id);
        $investasi->status = 2;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }


    public function getApprovedInvestment() 
    {
        $investasi = Investasi::where('investasi.status', '1')
                ->leftjoin('employers', 'employers.id', 'employer_id')
                ->select('investasi.*', 'employers.name as employername', 'employers.contact_person as cp')
                ->paginate(20);

        return view ('dashboard.pages.admins.approvedinvestment')->with('investasi', $investasi);
    }
    public function getUnapprovedInvestment() 
    {
        $investasi = Investasi::where('investasi.status', '2')
        ->leftjoin('employers', 'employers.id', 'employer_id')
        ->select('investasi.*', 'employers.name as employername', 'employers.contact_person as cp')
        ->paginate(20);
        return view ('dashboard.pages.admins.unapprovedinvestment')->with('investasi', $investasi);
    }
}
