<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Student;
use App\Job;
use App\Employer;
use App\Seminar;

class DashboardEmployerController extends Controller
{
    public function getSeminarsApproval(Request $request)
    {
        $where = [
            'employer_id' => $request->session()->get('id'),
        ];

        $seminars = Seminar::where($where)->paginate(20);

        // dd($seminars);

        return view('dashboard.pages.employer.seminar-approval')->with('seminars', $seminars);
    }

    public function getJobsApproval(Request $request) {

        $where = [
            'employer_id' => $request->session()->get('id'),
        ];

        $jobs = Job::where($where)->paginate(20);

        // dd($jobs);

        return view('dashboard.pages.employer.job-approval')->with('jobs', $jobs);
    }

    public function getJobsApplicantPending(Request $request) {

        $where_pending = [
            'employer_id' => $request->session()->get('id'),
            'job_student.status' => '0',
        ];
        $applicants_pending = DB::table('job_student')
                                ->join('students', 'job_student.student_id', 'students.id')
                                ->join('jobs', 'job_student.job_id', 'jobs.id')
                                ->join('employers', 'jobs.employer_id', 'employers.id')
                                ->select('students.*', 'job_student.created_at', 'job_student.updated_at', 'jobs.name as jobname', 'jobs.id as idjob', 'job_student.id as jsid', 'job_student.status as status', 'job_student.motivation_letter as motlet', 'job_student.cv as cv', 'employers.id as employerid')
                                ->where($where_pending)
                                ->paginate(20);

        // dd($applicants_pending);

        return view('dashboard.pages.employer.job-applicant-pending')->with('applicants_pending', $applicants_pending);
    }

    public function acceptNewApplicants(Request $request, $id)
    {

        $acc = DB::table('job_student')
                    ->where('id', $id)
                    ->update([
                        'status' => 1,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }

    public function rejectNewApplicants(Request $request, $id)
    {
        $acc = DB::table('job_student')
                    ->where('id', $id)
                    ->update([
                        'status' => 2,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }

    public function getJobsApplicantAccepted(Request $request)
    {
        $where_acc = [
            'employer_id' => $request->session()->get('id'),
            'job_student.status' => '1',
        ];
        $applicants_acc = DB::table('job_student')
                                ->join('students', 'job_student.student_id', 'students.id')
                                ->join('jobs', 'job_student.job_id', 'jobs.id')
                                ->join('employers', 'jobs.employer_id', 'employers.id')
                                ->select('students.*', 'jobs.name as jobname', 'jobs.id as idjob', 'job_student.status as status', 'job_student.motivation_letter as motlet', 'job_student.cv as cv', 'employers.id as employerid')
                                ->where($where_acc)
                                ->paginate(20);

        return view('dashboard.pages.employer.job-applicant-accepted')->with('applicants_acc', $applicants_acc);
    }

    public function getCreateSeminar()
    {
        return view('dashboard.pages.employer.create-seminar');
    }

    public function postCreateSeminar(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'name'          => 'required|max:255',
            'location'      => 'required|max:255',
            'category'      => 'required',
            'description'   => 'required|max:255',
            'contact_person'=> 'required|max:255',
            'contact_no'    => 'required|max:14',
            'fee'           => 'required',
            'berkas_sewa'   => 'required|mimes:pdf|max:2048'
        ]);
        $berkas= $request->file('berkas_sewa');
            $nama= str_replace(' ','_',$request->input('name'));
            $location = str_replace(' ','_',$request->input('location'));
            $desc= md5($request->input('description'));
            $extension= $berkas->getClientOriginalExtension();
            $filename= $nama.'_'.'_'.$location.'_'.$desc.'.'.$extension;
            $tujuan = 'data_files/bukti_sewa_tempat';
            $berkas->move($tujuan,$filename);
        try{
            Seminar::create([
                'name'                  => $request->input('name'),
                'location'              => $request->input('location'),
                'seminar_category_id'   => $request->input('category'),
                'description'           => $request->input('description'),
                'contact_person'        => $request->input('contact_person'),
                'contact_no'            => $request->input('contact_no'),
                'fee'                   => $request->input('fee'),
                'employer_id'           => $request->session()->get('id'),
                'berkas_verifikasi'     => $filename,
            ]);

            Session::flash('success', 'Seminar berhasil didaftarkan, silahkan tunggu konfirmasi seminar');
            return view('dashboard.pages.employer.create-seminar');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.employer.create-seminar');
        }

    }
    public function downloadBerkasBuktiSewa($seminar)
    {

      $where = [
          'seminars.id' => $seminar,
        //   'job_student.job_id'     => $arr[2],
      ];

      $berkas_db = DB::table('seminars')
      ->select('seminars.name as name', 'seminars.location as loc', 'seminars.description as desc','seminars.berkas_verifikasi as berkas')
      ->where($where)
      ->first();

    //   $pdfname= str_replace(' ','_',$berkas_db->name).'_'.md5($berkas_db->email).'.pdf';

    //   $file = public_path('data_files\\bukti_guests\\'.$pdfname);
      $file = public_path('data_files\\bukti_sewa_tempat\\'.$berkas_db->berkas);
      return response()->download($file, $berkas_db->berkas);
    }

    public function getCreateJob()
    {
        return view('dashboard.pages.employer.create-job');
    }

    public function postCreateJob(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'name'                  => 'required|max:255',
            'category'              => 'required',
            'job_type'              => 'required',
            'position'              => 'required|max:255',
            'location'              => 'required|max:255',
            'description'           => 'required',
            'minimal_qualification' => 'required|max:255',
            'required_skill'        => 'required|max:255',
            'extra_skill'           => 'max:255',
            'expected_salary_high'  => 'required|max:11',
            'expected_salary_low'   => 'required|max:11',
            'kompensasi'            => 'required|max:255',
        ]);

        if (is_null($request->input('extra_skill'))){
            $extra_skill = '-';
        }else {
            $extra_skill = $request->input('extra_skill');
        }
        // dd($extra_skill);
        // dd($request->session()->get('id'));

        try {
            Job::create([
                'name'                  => $request->input('name'),
                'employer_id'           => $request->session()->get('id'),
                'job_category_id'       => $request->input('category'),
                'job_type'              => $request->input('job_type'),
                'position'              => $request->input('position'),
                'location'              => $request->input('location'),
                'description'           => $request->input('description'),
                'minimal_qualification' => $request->input('minimal_qualification'),
                'required_skill'        => $request->input('required_skill'),
                'extra_skill'           => $extra_skill,
                'expected_salary_high'  => $request->input('expected_salary_high'),
                'expected_salary_low'   => $request->input('expected_salary_low'),
                'kompesasi'             => $request->input('kompensasi'), //typo di tabel, males benerin
            ]);

            Session::flash('success', 'Job berhasil didaftarkan, silahkan tunggu konfirmasi job');
            return view('dashboard.pages.employer.create-job');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.employer.create-job');
        }

        // return view('dashboard.pages.employer.create-job');
    }

    public function getProfilePage(Request $request)
    {
        $where = [
            'id' => $request->session()->get('id'),
        ];

        $employer = Employer::where($where)->first();
        // dd($employer);

        return view('dashboard.pages.employer.profile')->with('employer', $employer);
    }
}
