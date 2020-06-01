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
                        ->select('guest_services.id as gsid', 'guests.name as guestname', 'services.name as servicename', 'guests.email', 'guests.mobile_no', 'guest_services.status', 'guest_services.created_at', 'guest_services.updated_at')
                        ->where($where_pending)
                        ->paginate(20);
        
        // dd($applicants);

        return view('dashboard.pages.student.service-applicant-pending')->with('applicants', $applicants);
    }

    public function acceptNewApplicants(Request $request, $id)
    {

        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status' => 1,
                    ]);

        return redirect()->back();
    }

    public function rejectNewApplicants(Request $request, $id)
    {
        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status' => 2,
                    ]);

        return redirect()->back();
    }

    public function getServicesApplicantAccepted(Request $request)
    {
        $where_done = [
            'student_id' => $request->session()->get('id'),
            'guest_services.status' => '1',
            'guest_services.status_pekerjaan' => '1',
        ];

        $applicants_done = DB::table('guest_services')
                        ->join('guests', 'guest_services.guest_id', 'guests.id')
                        ->join('services', 'guest_services.service_id', 'services.id')
                        ->join('students', 'services.student_id', 'students.id')
                        ->select('guest_services.id as gsid', 'guests.name as guestname', 'services.name as servicename', 'guests.email', 'guests.mobile_no', 'guest_services.status', 'guest_services.status_pekerjaan', 'guest_services.created_at', 'guest_services.updated_at')
                        ->where($where_done)
                        ->paginate(20);

        $where_notdone = [
            'student_id' => $request->session()->get('id'),
            'guest_services.status' => '1',
            'guest_services.status_pekerjaan' => '0',
        ];

        $applicants_notdone = DB::table('guest_services')
                        ->join('guests', 'guest_services.guest_id', 'guests.id')
                        ->join('services', 'guest_services.service_id', 'services.id')
                        ->join('students', 'services.student_id', 'students.id')
                        ->select('guest_services.id as gsid', 'guests.name as guestname', 'services.name as servicename', 'guests.email', 'guests.mobile_no', 'guest_services.status', 'guest_services.status_pekerjaan', 'guest_services.created_at', 'guest_services.updated_at')
                        ->where($where_notdone)
                        ->paginate(20);
        
        // dd($applicants_notdone);

        return view('dashboard.pages.student.service-applicant-accepted')->with('applicants_done', $applicants_done)->with('applicants_notdone', $applicants_notdone);
    }

    public function doneServices(Request $request, $id)
    {

        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status_pekerjaan' => 1,
                    ]);

        return redirect()->back();
    }

    public function notdoneServices(Request $request, $id)
    {
        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status_pekerjaan' => 0,
                    ]);

        return redirect()->back();
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
                    ->select('job_student.created_at', 'job_student.updated_at', 'jobs.name as jobname', 'employers.name as empname', 'employers.email', 'job_student.status')
                    ->where($where)
                    ->paginate(20);

        // dd($jobs);

        return view('dashboard.pages.student.job-approval')->with('jobs', $jobs);
    }
}