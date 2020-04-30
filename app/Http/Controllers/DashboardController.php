<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Student;
use App\Job;
use App\Employer;
use App\Seminar;


class DashboardController extends Controller
{
    public function getHome(Request $request) {

        if ($request->session()->get('role') == 'admin') {
            return view('dashboard.pages.admins.home');
        } elseif ($request->session()->get('role') == 'employer') {
            return view('dashboard.pages.employers.home');
        }
        return view('/');
    }

    // manage users admin
    public function getUserList() {

        $students = Student::select('name', 'nrp', 'email')->paginate(20);

        return view ('dashboard.pages.admins.userlist')->with('students', $students);
    }

    //manage employers admin
    public function getNewEmployers() {

        $employers = Employer::where('status', '2')->paginate(20);

        return view ('dashboard.pages.admins.newemployers')->with('employers', $employers);
    }

    public function getAprrovedEmployers() {

        $employers = Employer::where('status', '1')->paginate(20);

        return view ('dashboard.pages.admins.approvedemployers')->with('employers', $employers);
    }

    public function getUnapprovedEmployers() {

        $employers = Employer::where('status', '0')->paginate(20);

        return view ('dashboard.pages.admins.unapprovedemployers')->with('employers', $employers);
    }

    // manage jobs admin
    public function getNewJobs() {

        $jobs = Job::where('jobs.status', '2')
                ->leftjoin('employers', 'employers.id', 'employer_id')
                ->leftjoin('job_categories', 'job_categories.id', 'job_category_id')
                ->select('jobs.*', 'employers.name as employer_name', 'job_categories.name as category_name')
                ->paginate(20);

        return view ('dashboard.pages.admins.newjobs')->with('jobs', $jobs);
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

        $jobs = Job::where('jobs.status', '0')
        ->leftjoin('employers', 'employers.id', 'employer_id')
        ->leftjoin('job_categories', 'job_categories.id', 'job_category_id')
        ->select('jobs.*', 'employers.name as employer_name', 'job_categories.name as category_name')
        ->paginate(20);


        return view ('dashboard.pages.admins.unapprovedjobs')->with('jobs', $jobs);
    }

    // manage jobs admin
    public function getNewSeminars() {

        $seminars = Seminar::where('status', '2')->paginate(20);

        return view ('dashboard.pages.admins.newseminars')->with('seminars', $seminars);
    }
    public function getApprovedSeminars() {

        $seminars = Seminar::where('status', '1')->paginate(20);

        return view ('dashboard.pages.admins.approvedseminars')->with('seminars', $seminars);
    }
    public function getUnapprovedSeminars() {

        $seminars = Seminar::where('status', '0')->paginate(20);

        return view ('dashboard.pages.admins.unapprovedseminars')->with('seminars', $seminars);
    }

}
