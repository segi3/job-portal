<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Student;
use App\Job;
use App\Employer;
use App\Investasi;
use App\InvestasiStudent;
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
            'kompensasi'            => 'max:255',
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


    public function getCreateInvestation()
    {
        return view('dashboard.pages.employer.create-investation');
    }

    public function postCreateInvestation(Request $request){

        $this->validate($request, [
            'description'   => 'required',
            'namabank'      => 'required',
            'nomorrekening' => 'required|numeric',
            'hargaperlembar' => 'required|numeric',
            'totallembar' => 'required|numeric|min: 1',
            'roi_d'         => 'required|numeric',
            'roi_u'         => 'required|numeric|gt:roi_d',
            'duedate'       => 'required|date',
            'proposalinvestasi'   => 'required|mimes:pdf|max:2048',
            'laporankeuangan'   => 'required|mimes:pdf|max:2048',
            // 'termpolicy'        => 'required',
        ]);

            $berkasinvestasi= $request->file('proposalinvestasi');
            $berkaskeuangan= $request->file('laporankeuangan');
            $employerid= $request->session()->get('id');
            $employername = $request->session()->get('name');
            $tujuaninv = 'data_files/propsal_investasi';
            $tujuankeu = 'data_files/lap_keu';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "Invesment_".$employerid.md5('_INV_'.$employername.'_'.$request->input('description')).'.'.$extension;
            $filenamekeu= "Keuangan_".$employerid.md5('_KEU_'.$employername.'_'.$request->input('description')).'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkasinvestasi->move($tujuaninv,$filenameinv);
            $berkaskeuangan->move($tujuankeu,$filenamekeu);
            $formatDate = \Carbon\Carbon::parse($request->input('duedate'))->format('Y-m-d');
        try{
            Investasi::create([
                'employer_id'           => $request->session()->get('id'),
                'status'                => 0,
                'status_tempo'          => 0,
                'bank'                  => $request->input('namabank'),
                'no_rekening'           => $request->input('nomorrekening'),
                'deskripsi_bisnis'      => $request->input('description'),
                'roi_top'               => $request->input('roi_u'),
                'roi_bot'               => $request->input('roi_d'),
                'lembar_total'          => $request->input('totallembar'),
                'lembar_terbeli'        => 0,
                'harga_saham'           => $request->input('hargaperlembar'),
                'tgl_jatuh_tempo'       => $formatDate,
                'berkas_proposal_investasi'  => $filenameinv,
                'berkas_laporan_keuangan'  => $filenamekeu,
            ]);

            Session::flash('success', 'Investasi berhasil didaftarkan, silahkan tunggu konfirmasi dari pihak admin');
            return view('dashboard.pages.employer.create-investation');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.employer.create-investation');
        }
    }

    public function getInvestationsApproval(Request $request)
    {
        $where = [
            'employer_id' => $request->session()->get('id'),
        ];

        $investation = Investasi::where($where)->paginate(20);

        // dd($seminars);

        return view('dashboard.pages.employer.investation-approval')->with('investations', $investation);
    }

    public function getPaidInvestor(Request $request)
    {
        $where = [
            'employer_id' => $request->session()->get('id'),
            'status_bayar' =>1,
        ];
        $where2 = [
            'employer_id' => $request->session()->get('id'),
        ];
        $investations = DB::table('investasi_student')
                                ->join('investasi', 'investasi_student.investasi_id', 'investasi.id')
                                ->join('employers', 'investasi.employer_id', 'employers.id')
                                ->join('students', 'investasi_student.student_id', 'students.id')
                                ->select(
                                    'investasi_student.id as isid',
                                    'investasi_student.student_id as isstudent_id',
                                    'investasi_student.investasi_id as isinvestasi_id',
                                    'investasi_student.status_bayar as isstatus_bayar',
                                    'investasi_student.status_uang_balik as isstatus_uang_balik',
                                    'investasi_student.lembar_beli as islembar_beli',
                                    'investasi_student.berkas_ktp as isktp_investor',
                                    'investasi_student.berkas_bukti_pembayaran as isbukti_bayar_investor',
                                    'investasi_student.updated_at as updated',
                                    'students.name as s_name',
                                    'students.id as s_id',
                                    'students.nrp as nrp',
                                    'students.email as s_email',
                                    'students.mobile_no as s_mobile_no',
                                    'students.skill as s_skill',
                                    'students.achievment as s_achievment',
                                    'students.experience as s_experience',
                                    'students.city as s_city',
                                    'students.province as s_province',
                                    'investasi.employer_id as employer_id',
                                    'investasi.nama_investasi as in_nama_investasi')
                                ->where($where)
                                ->paginate(20);

        $employerInvestation = DB::table('investasi')
                                ->select('investasi.id','investasi.nama_investasi')
                                ->where($where2)
                                ->get();
        // $investation = InvestasiStudent::where($where)->paginate(20);

        // dd($investations->firstItem());

        return view('dashboard.pages.employer.investation-paid-investor', compact('investations','employerInvestation'));
    }
    public function confirmPaidInvestor(Request $request, $id){
        // dd($id);
        $invid = DB::table('investasi_student')
                    ->select('investasi_student.investasi_id as investasi_id',
                              'investasi_student.lembar_beli as beli')
                    ->where('id', $id)
                    ->get();

        $currentL = DB::table('investasi')
                    ->select('investasi.lembar_terbeli as terbeli')
                    ->where('id', $invid->first()->investasi_id)
                    ->get();
        $updateL=$currentL->first()->terbeli + $invid->first()->beli;
        $acc = DB::table('investasi_student')
                    ->where('id', $id)
                    ->update([
                        'status_bayar' => 2,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
        $acc2 = DB::table('investasi')
                    ->where('id', $invid->first()->investasi_id)
                    ->update([
                        'lembar_terbeli' => $updateL,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
        return redirect()->back();

    }
}

