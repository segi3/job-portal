<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Student;
use App\Job;
use App\Employer;
use App\Seminar;
use App\Service;


class DashboardStudentController extends Controller
{
    public function getCreateService()
    {
        return view('dashboard.pages.student.create-service');
    }

    public function postCreateService(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name'          => 'required|max:255',
            'category'      => 'required',
            'description'   => 'required|max:255',
        ]);

        try{
            Service::create([
                'name'                  => $request->input('name'),
                'description'           => $request->input('description'),
                'job_category_id'       => $request->input('category'),
                'student_id'            => $request->session()->get('id'),
                'status'                => 0,
            ]);

            Session::flash('success', 'Jasa berhasil didaftarkan, silahkan tunggu konfirmasi jasa');
            return view('dashboard.pages.student.create-service');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.student.create-service');
        }
        
    }

    public function getServicesApproval(Request $request)
    {
        $where = [
            'student_id' => $request->session()->get('id'),
        ];

        $services = Service::where($where)->paginate(20);

        // dd($services);

        return view('dashboard.pages.student.service-approval')->with('services', $services);
    }

    public function getServicesApplicantPending(Request $request)
    {
        $where_pending = [
            'student_id' => $request->session()->get('id'),
            'guest_services.status' => '0',
        ];

        $applicants = DB::table('guest_services')
                        ->join('guests', 'guest_services.guest_id', 'guests.id')
                        ->join('services', 'guest_services.service_id', 'services.id')
                        ->join('students', 'services.student_id', 'students.id')
                        ->select('guests.name as guestname', 'services.name as servicename', 'guests.email', 'guests.mobile_no', 'guest_services.status')
                        ->where($where_pending)
                        ->paginate(20);
        
        // dd($applicants);

        return view('dashboard.pages.student.service-applicant-pending')->with('applicants', $applicants);
    }

    public function getServicesApplicantAccepted(Request $request)
    {
        $where_acc = [
            'student_id' => $request->session()->get('id'),
            'guest_services.status' => '1',
        ];

        $applicants = DB::table('guest_services')
                        ->join('guests', 'guest_services.guest_id', 'guests.id')
                        ->join('services', 'guest_services.service_id', 'services.id')
                        ->join('students', 'services.student_id', 'students.id')
                        ->select('guests.name as guestname', 'services.name as servicename', 'guests.email', 'guests.mobile_no', 'guest_services.status')
                        ->where($where_acc)
                        ->paginate(20);
        
        // dd($applicants);

        return view('dashboard.pages.student.service-applicant-accepted')->with('applicants', $applicants);
    }

    public function getJobsApproval(Request $request)
    {
        $where = [ 
            'job_student.student_id' => $request->session()->get('id'),
        ];

        $jobs = DB::table('job_student')
                    ->join('students', 'job_student.student_id', 'students.id')
                    ->join('jobs', 'job_student.job_id', 'jobs.id')
                    ->join('employers', 'jobs.employer_id', 'employers.id')
                    ->select('jobs.name as jobname', 'employers.name as empname', 'employers.contact_person', 'employers.contact_no', 'job_student.status')
                    ->where($where)
                    ->paginate(20);

        // dd($jobs);

        return view('dashboard.pages.student.job-approval')->with('jobs', $jobs);
    }
}
