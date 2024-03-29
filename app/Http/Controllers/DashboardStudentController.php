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
use Validator;


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
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }

    public function rejectNewApplicants(Request $request, $id)
    {
        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status' => 2,
                        'updated_at' => \Carbon\Carbon::now(),
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

    // public function doneServices(Request $request, $id)
    // {

    //     $acc = DB::table('guest_services')
    //                 ->where('id', $id)
    //                 ->update([
    //                     'status_pekerjaan' => 1,
    //                     'updated_at' => \Carbon\Carbon::now(),
    //                 ]);

    //     return redirect()->back();
    // }

    // public function notdoneServices(Request $request, $id)
    // {
    //     $acc = DB::table('guest_services')
    //                 ->where('id', $id)
    //                 ->update([
    //                     'status_pekerjaan' => 0,
    //                     'updated_at' => \Carbon\Carbon::now(),
    //                 ]);

    //     return redirect()->back();
    // }

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

    public function getProfilePage(Request $request)
    {
        $where = [
            'id' => $request->session()->get('id'),
        ];

        $student = Student::where($where)->first();

        return view('dashboard.pages.student.profile')->with('student', $student);
    }

    public function editProfilePage(Request $request)
    {
        $where = [
            'id' => $request->session()->get('id'),
        ];

        $student = Student::where($where)->first();

        return view('dashboard.pages.student.profile-edit')->with('student', $student);
    }

    public function updateProfilePage(Request $request)
    {


        $student = Student::find($request->session()->get('id'));

        if ($request->email != $student->email){
            $this->validate($request, [
                'email' => 'required|email|unique:students',
            ]);
        };

        if ($request->nrp != $student->nrp){
            $this->validate($request, [
                'nrp'   => 'required|min:14|max:14|unique:students',
            ]);
        };

        $input = $request->all();
        $validator = Validator::make($input, [
            'email'         => 'required|email',
            'name'          => 'required',
            'nrp'           => 'required|min:14|max:14',
            'gender'        => 'required',
            'birthday'      => 'required',
            'mobile_no'     => 'required|min:10|max:14',
            'address'       => 'required|max:255',
            'city'          => 'required|max:255',
            'province'      => 'required|max:255',
            'hobby'         => 'required|max:255',
            'skill'         => 'required|max:255',
            'achievment'    => 'required|max:255',
            'experience'    => 'required|max:255',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back();
        }
        $student = Student::find($request->session()->get('id'));

        // dd($request->session()->get('id'));
        $formatDate = \Carbon\Carbon::parse($request->input('birthday'))->format('Y-m-d');

        try {


            $student->name = $request->input('name');
            $student->nrp = $request->input('nrp');
            $student->gender = $request->input('gender');
            $student->birthdate = $formatDate;
            $student->address = $request->input('address');
            $student->city = $request->input('city');
            $student->province = $request->input('province');
            $student->hobby = $request->input('hobby');
            $student->skill = $request->input('skill');
            $student->achievment = $request->input('achievment');
            $student->experience = $request->input('experience');
            $student->email = $request->input('email');
            $student->mobile_no = $request->input('mobile_no');



            $student->save();
            Session::flash('success', 'Profil berhasil di ubah');
            return redirect('/dashboard/st/profile');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return redirect()->back();
        }
    }
    public function InvestReturnApproval(Request $request)
    {
        $where = [
            'investasi_student.student_id' => $request->session()->get('id'),
            'investasi_student.status_uang_balik' => 0,
        ];
        $invests = DB::table('investasi')
                    ->join('investasi_student', 'investasi_student.investasi_id', 'investasi.id')
                    ->join('employers', 'investasi.employer_id', 'employers.id')
                    ->select('investasi.nama_investasi','employers.name as employername', 'investasi.tgl_jatuh_tempo', 'investasi_student.id')
                    ->where($where)
                    ->whereDate('investasi.tgl_jatuh_tempo', '=', \Carbon\Carbon::now()->toDateString())
                    ->paginate(20);
        return view('dashboard.pages.student.invest-return-approval')->with('invests', $invests);
    }
    public function approveInvestReturn($id)
    {
        $where = [
            'investasi_student.id' => $id,
        ];
        DB::table('investasi_student')
        ->where($where)
        ->update(['investasi_student.status_uang_balik' => 1]);

        return redirect()->back();
    }

    public function getOrderList(Request $request)
    {
        $where = [
            'id_investor' => $request->session()->get('id'),
            'role' => $request->session()->get('role'),
        ];

        $orders = Order::where($where)->orderBy('updated_at', 'desc')->paginate(25);

        return view('dashboard.pages.order-list')->with('orders', $orders);
    }

    public function showProjectListStudent(Request $request)
    {
        $studentid= $request->session()->get('id');
        $investment = DB::table('order')
                        ->select('order.*')
                        ->where('order.id_investor', '=', $studentid)
                        ->where('role', '=', 'student')
                        ->where('status', '=', 'paid')
                        ->where('tipe_investasi', '=', 'project')
                        ->paginate(25);
        return view('dashboard.pages.student.on-going-project-list')->with('investment', $investment);
    }
    public function showDetailInvestment(Request $request, $id)
    {
        $studentid= $request->session()->get('id');
        $order = DB::table('order')
                    ->select('order.id_investee')
                    ->where('id_investor', '=', $studentid)
                    ->where('status', '=', 'paid')
                    ->where('role', '=', 'student')
                    ->where('id_investasi', '=', $id)
                    ->where('tipe_investasi', '=', 'project')
                    ->first();
        $investee = DB::table('investee')
                    ->select('investee.*')
                    ->where('id', '=', $order->id_investee)
                    ->first();
        $investment = DB::table('investasi_project')
                    ->select('investasi_project.*')
                    ->where('investasi_project.id', '=', $id)
                    ->first();
        $listprogres = DB::table('progres_project')
                        -> select('progres_project.*')
                        -> where('progres_project.project_id','=', $id)
                        -> orderByRaw('tgl DESC')
                        ->paginate(8);
        return view('dashboard.pages.student.detail-investment',compact('investee','listprogres','investment'));
    }
}
