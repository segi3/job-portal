<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Job;
use App\Employer;
use App\Guest;
use App\Seminar;
use App\Service;
use App\Investasi_project;
use App\Investasi_funding;
use App\Investasi_iyt;
use App\Investee;
use App\IYTBatch;


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
        } else if ($request->session()->get('role') == 'mentor') {
            return view ('dashboard.pages.mentor.home');
        }
        return view('/');
    }

    public function getInvestee() {
        return view('dashboard.pages.investee.home');
    }

    // manage users admin
    public function getNewStudents()
    {

        $students = Student::where('students.status', '0')
            ->select('students.*')
            ->paginate(20);

        return view ('dashboard.pages.admins.newstudents')->with('students', $students);
    }
    public function getApprovedStudents()
    {

        $students = Student::where('students.status', '1')
            ->select('students.*')
            ->paginate(20);

        return view ('dashboard.pages.admins.approvedstudents')->with('students', $students);
    }
    public function getUnapprovedStudents()
    {

        $students = Student::where('students.status', '2')
            ->select('students.*')
            ->paginate(20);
        return view ('dashboard.pages.admins.unapprovedstudents')->with('students', $students);
    }

    public function approveNewStudents(Request $request, $id)
    {
        $student = Student::find($id);
        $student->status = 1;
        // $student->admin_id = $request->session()->get('id');

        $student->save();

        return redirect()->back();
    }

    public function rejectNewStudents(Request $request, $id)
    {
        $student = Student::find($id);

        $student->status = 2;
        // $student->admin_id = $request->session()->get('id');
        $student->save();

        return redirect()->back();
    }
    public function downloadBerkasStudent($berkas)
    {
        $where = [
            'students.id' => $berkas,
        ];

        $berkas_db = DB::table('students')
        ->select('students.berkas_validasi as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/berkas_validasi/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
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

    public function getNewProjInvestment() {

        $investasi = Investasi_project::where('investasi_project.status', '0')
                ->leftjoin('investee', 'investee.id', 'investee_id')
                ->leftjoin('students', 'students.id', 'investee.student_id')
                ->select('investasi_project.*', 'students.name as mahasiswa', 'investee.nama as investee', 'investee.contact_person as cp', 'investee.contact_no as kontak')
                ->paginate(20);

        return view('dashboard.pages.admins.newprojinvestment')->with('investasi', $investasi);
    }

    public function approveNewProjInvestment(Request $request, $id)
    {
        $investasi = Investasi_project::find($id);

        $investasi->status = 1;
        $investasi->status_tempo = 1;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }

    public function rejectNewProjInvestment(Request $request, $id)
    {
        $investasi = Investasi_project::find($id);
        $investasi->status = 2;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }


    public function getApprovedProjInvestment()
    {
        $investasi = Investasi_project::where('investasi_project.status', '1')
                ->leftjoin('investee', 'investee.id', 'investee_id')
                ->leftjoin('students', 'students.id', 'investee.student_id')
                ->select('investasi_project.*', 'students.name as mahasiswa', 'investee.nama as investee', 'investee.contact_person as cp', 'investee.contact_no as kontak')
                ->paginate(20);

        return view ('dashboard.pages.admins.approvedprojinvestment')->with('investasi', $investasi);
    }
    public function getUnapprovedProjInvestment()
    {
        $investasi = Investasi_project::where('investasi_project.status', '2')
        ->leftjoin('investee', 'investee.id', 'investee_id')
        ->leftjoin('students', 'students.id', 'investee.student_id')
        ->select('investasi_project.*', 'students.name as mahasiswa', 'investee.nama as investee', 'investee.contact_person as cp', 'investee.contact_no as kontak')
        ->paginate(20);
        return view ('dashboard.pages.admins.unapprovedprojinvestment')->with('investasi', $investasi);
    }

    public function downloadproposalproj($proposal)
    {
        $where = [
            'investasi_project.id' => $proposal,
        ];

        $berkas_db = DB::table('investasi_project')
        ->select('investasi_project.berkas_proposal_investasi as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/Investee/Project/proposal_investasi/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }

    public function downloadlaporanproj($laporan)
    {
        $where = [
            'investasi_project.id' => $laporan,
        ];

        $berkas_db = DB::table('investasi_project')
        ->select('investasi_project.berkas_laporan_keuangan as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/Investee/Project/lap_keu/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }

    public function getNewFundInvestment() {

        $investasi = Investasi_funding::where('investasi_funding.status', '0')
                ->leftjoin('investee', 'investee.id', 'investee_id')
                ->leftjoin('students', 'students.id', 'investee.student_id')
                ->select('investasi_funding.*', 'students.name as mahasiswa', 'investee.nama as investee',  'investee.contact_person as cp', 'investee.contact_no as kontak')
                ->paginate(20);

        return view('dashboard.pages.admins.newfundinvestment')->with('investasi', $investasi);
    }

    public function approveNewFundInvestment(Request $request, $id)
    {
        $investasi = Investasi_funding::find($id);

        $investasi->status = 1;
        $investasi->status_tempo = 1;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }

    public function rejectNewFundInvestment(Request $request, $id)
    {
        $investasi = Investasi_funding::find($id);
        $investasi->status = 2;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }


    public function getApprovedFundInvestment()
    {
        $investasi = Investasi_funding::where('investasi_funding.status', '1')
                ->leftjoin('investee', 'investee.id', 'investee_id')
                ->leftjoin('students', 'students.id', 'investee.student_id')
                ->select('investasi_funding.*', 'students.name as mahasiswa', 'investee.nama as investee',  'investee.contact_person as cp', 'investee.contact_no as kontak')
                ->paginate(20);

        return view ('dashboard.pages.admins.approvedfundinvestment')->with('investasi', $investasi);
    }
    public function getUnapprovedFundInvestment()
    {
        $investasi = Investasi_funding::where('investasi_funding.status', '2')
        ->leftjoin('investee', 'investee.id', 'investee_id')
        ->leftjoin('students', 'students.id', 'investee.student_id')
        ->select('investasi_funding.*',  'students.name as mahasiswa', 'investee.nama as investee', 'investee.contact_person as cp', 'investee.contact_no as kontak')
        ->paginate(20);
        return view ('dashboard.pages.admins.unapprovedfundinvestment')->with('investasi', $investasi);
    }

    public function downloadproposalfund($proposal)
    {
        $where = [
            'investasi_funding.id' => $proposal,
        ];

        $berkas_db = DB::table('investasi_funding')
        ->select('investasi_funding.berkas_proposal_investasi as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/Investee/Funding/proposal_investasi/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }

    public function downloadlaporanfund($laporan)
    {
        $where = [
            'investasi_funding.id' => $laporan,
        ];

        $berkas_db = DB::table('investasi_funding')
        ->select('investasi_funding.berkas_laporan_keuangan as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/Investee/Funding/lap_keu/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }


    public function getNewInvestees()
    {

        $investees = Investee::where('investee.status', '0')
                    ->leftjoin('students', 'students.id', 'investee.student_id')
                    ->select('investee.*', 'students.name as nama_mhs')
                    ->paginate(20);


        return view('dashboard.pages.admins.newinvestees')->with('investees', $investees);
    }

    public function getApprovedInvestees()
    {
        $investees = Investee::where('investee.status', '1')
        ->leftjoin('students', 'students.id', 'investee.student_id')
        ->select('investee.*', 'students.name as nama_mhs')
        ->paginate(20);


        return view('dashboard.pages.admins.approvedinvestees')->with('investees', $investees);
    }

    public function getUnapprovedInvestees()
    {
        $investees = Investee::where('investee.status', '2')
        ->leftjoin('students', 'students.id', 'investee.student_id')
        ->select('investee.*', 'students.name as nama_mhs')
        ->paginate(20);


        return view('dashboard.pages.admins.unapprovedinvestees')->with('investees', $investees);
    }

    public function approveNewInvestees(Request $request, $id)
    {
        $investee = Investee::find($id);

        $investee->status = 1;
        $investee->admin_id = $request->session()->get('id');
        $investee->save();

        return redirect()->back();
    }

    public function rejectNewInvestees(Request $request, $id)
    {
        $investee = Investee::find($id);

        $investee->status = 1;
        $investee->admin_id = $request->session()->get('id');
        $investee->save();

        return redirect()->back();
    }

    public function downloadFormEmployer($form)
    {
        $where = [
            'jobs.id' => $form,
        ];

        $berkas_db = DB::table('jobs')
        ->select('order_rekrutmen as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Employer/Job/Order Rekrutmen/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }

    public function getListAllIYT() {

        $iyts = Investasi_iyt::where('investasi_iyt.status', '0')
                ->leftjoin('students', 'students.id', 'investasi_iyt.student_id')
                ->select('investasi_iyt.*', 'students.email')
                ->paginate(20);

        // $batch= IYTBatch::where('id',$iyts)
        return view('dashboard.pages.admins.iyt-list-all')->with('iyts', $iyts);
    }

    public function approveIYT(Request $request, $id)
    {
        $investasi = Investasi_iyt::find($id);

        $investasi->status = 1;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }

    public function rejectIYT(Request $request, $id)
    {
        $investasi = Investasi_iyt::find($id);
        $investasi->status = 0;
        $investasi->admin_id = $request->session()->get('id');
        $investasi->save();
        return redirect()->back();
    }


    public function getListQualifyIYT()
    {
        $iyts = Investasi_iyt::where('investasi_iyt.status', '1')
                ->leftjoin('students', 'students.id', 'investasi_iyt.student_id')
                ->select('investasi_iyt.*', 'students.email')
                ->paginate(20);

        return view('dashboard.pages.admins.iyt-qualify')->with('iyts', $iyts);
    }
    public function viewCreateIYTBatch(){
        return view('dashboard.pages.admins.iyt-create-batch');

    }
    public function createIYTBatch(Request $request){
        $this->validate($request, [
            'batch'      => 'required|numeric|unique:i_y_t_batches',
            'start_date'      => 'required|date',
            'end_date'   => 'required|date|afteror_equal:start_date',

        ]);
        $startDate = \Carbon\Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $endDate = \Carbon\Carbon::parse($request->input('end_date'))->format('Y-m-d');
            // $formatDate = \Carbon\Carbon::parse($request->input('waktu'))->format('Y-m-d');
        try{
            IYTBatch::create([
                'name'       => $request->input('IYTname'),
                'batch'      => $request->input('batch'),
                'start_date'      => $startDate,
                'status'        => 1,
                'end_date'   => $endDate,
            ]);

            Session::flash('success', 'Batch IYT Baru telah berhasil dibuat');
            return view('dashboard.pages.admins.iyt-create-batch');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.admins.iyt-create-batch');
        }

    }
    public function downloadProposalBisnis($prop)
    {
        $where = [
            'investasi_iyt.id' => $prop,
        ];

        $berkas_db = DB::table('investasi_iyt')
        ->select('berkas_proposal_bisnis as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/IYT/Proposal Bisnis/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }
    public function downloadPitchDesk($prop)
    {
        $where = [
            'investasi_iyt.id' => $prop,
        ];

        $berkas_db = DB::table('investasi_iyt')
        ->select('berkas_pitch_desk as berkas')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/IYT/Pitch Desk/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }

    public function getListBatches()
    {
        $batches = DB::table('i_y_t_batches')->paginate(20);
        return view('dashboard.pages.admins.list-batch')->with('batches', $batches);
    }

    // public function getNonActiveBatches()
    // {
    //     $batches = IYTBatch::where('status', '0')
    //     ->select('*')
    //     ->paginate(20);
    //     return view('dashboard.pages.admins.non-active-batch')->with('batches', $batches);
    // }

    public function changeToActive(Request $request, $id)
    {
        $batches = IYTBatch::find($id);
        $batches->status = 1;
        $batches->save();
        return redirect()->back();
    }

    public function changeToNonActive(Request $request, $id)
    {
        $batches = IYTBatch::find($id);
        $batches->status = 0;
        $batches->save();
        return redirect()->back();
    }
}
