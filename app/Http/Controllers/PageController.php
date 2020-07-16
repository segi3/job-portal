<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Job;
use App\JobCategory;
use App\Employer;

class PageController extends Controller
{
    public function getHome()
    {
        $jobcategory= DB::table('job_categories')->select('name','slug')->get();
        $jobcategorypop = DB::table('jobs')
        ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
        ->select('jobs.job_category_id as id','job_categories.name as name', 'job_categories.slug as slug',DB::raw('count(jobs.job_category_id) as jumlah'))
        ->groupBy('jobs.job_category_id','job_categories.name','job_categories.slug')
        ->orderBy('jumlah', 'DESC')
        ->limit(5)
        ->get();
        $job = DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->join('employers', 'jobs.employer_id', 'employers.id')
                            ->select('jobs.expected_salary_high', 'jobs.expected_salary_low', 'jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername', 'employers.logo')
                            ->where('jobs.status', '=', 1)
                            ->orderByDesc('jobs.created_at')
                            ->limit(5)
                            ->get();
        $seminar = DB::table('seminars')
                            ->join('seminar_categories', 'seminars.seminar_category_id' ,'seminar_categories.id')
                            ->join('employers', 'seminars.employer_id', 'employers.id')
                            ->select('seminars.fee', 'seminars.id as id','seminars.name as name', 'seminars.location as location', 'employers.name as employername', 'employers.logo')
                            ->where('seminars.status', '=', 1)
                            ->orderByDesc('seminars.created_at')
                            ->limit(5)
                            ->get();
        $jasa = DB::table('services')
                            ->join('students', 'services.student_id', 'students.id')
                            ->select('services.id', 'services.name', 'students.name as studname')
                            ->where('services.status', '=', 1)
                            ->orderByDesc('services.created_at')
                            ->limit(5)
                            ->get();
        return view('pages.home', compact('jobcategory', 'jobcategorypop','job', 'seminar', 'jasa'));
    }

    public function search(Request $request)
    {
        $jobcategory = DB::table('job_categories')->select('name','slug')->get();
        $slug= $request->get('category');
        $tipe = $request->get('job_type');
        if($slug !="all" && $tipe!="all" )
        {
            $where_pending = [
                'job_categories.slug' => $slug,
                'jobs.status' => '1',
                'job_type' => $tipe,
            ];
            $jobsCount= DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->where($where_pending)
                            ->count();
            $job = DB::table('jobs')
                                  ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                                  ->join('employers', 'jobs.employer_id', 'employers.id')
                                  ->select('jobs.expected_salary_high', 'jobs.expected_salary_low', 'employers.logo as emplogo', 'jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
                                  ->where($where_pending)
                                  ->paginate(8);
            return view('job-list',compact('jobcategory', 'job','jobsCount'));
        }
        elseif($slug != "all" )
        {
            $where_pending = [
                'job_categories.slug' => $slug,
                'jobs.status' => '1',
            ];
            $jobsCount= DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->where($where_pending)
                            ->count();
            $job = DB::table('jobs')
                                  ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                                  ->join('employers', 'jobs.employer_id', 'employers.id')
                                  ->select('jobs.expected_salary_high', 'jobs.expected_salary_low', 'employers.logo as emplogo', 'jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
                                  ->where($where_pending)
                                  ->paginate(8);
            return view('job-list',compact('jobcategory', 'job','jobsCount'));
        }
        elseif($tipe !="all")
        {
            $where_pending = [
                'jobs.status' => '1',
                'job_type' => $tipe,
            ];
            $jobsCount= DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->where($where_pending)
                            ->count();
            $job = DB::table('jobs')
                                  ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                                  ->join('employers', 'jobs.employer_id', 'employers.id')
                                  ->select('jobs.expected_salary_high', 'jobs.expected_salary_low', 'employers.logo as emplogo', 'jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
                                  ->where($where_pending)
                                  ->paginate(8);
            return view('job-list',compact('jobcategory', 'job','jobsCount'));
        }
        else
        {
            return redirect()->route('jobs');
        }
        
    }

    public function showWelcomeLogin() {

        return view('pages.login-welcome');
    }

    public function showLoginWarning() {

        return view('pages.employer.login-warning');
    }

    public function showSK()
    {
        return view('syarat-ketentuan');
    }
}
