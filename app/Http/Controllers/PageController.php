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
    //   $jobcategorypop = DB::table('jobs')
    //     ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
    //     ->select('job_categories.*', 'COUNT (jobs.job_category_id) as jumlah')
    //     ->groupBy('jobs.job_categories.id')
    //     ->orderBy('jumlah', 'DESC')
    //     ->limit(5)
    //     ->get();
      $job = DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->join('employers', 'jobs.employer_id', 'employers.id')
                            ->select('jobs.expected_salary_high', 'jobs.expected_salary_low', 'jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername', 'employers.logo')
                            ->where('jobs.status', '=', 1)
                            ->orderByDesc('jobs.created_at')
                            ->limit(5)
                            ->get();
        return view('pages.home', compact('jobcategory', 'job'));
    }

    public function showWelcomeLogin() {

        return view('pages.login-welcome');
    }

    public function showLoginWarning() {

        return view('pages.employer.login-warning');
    }
}
