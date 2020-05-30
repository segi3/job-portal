<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Job;
use App\JobCategory;
use App\Employer;


class JobController extends Controller
{
    public function index()
    {
      $jobcategory = DB::table('job_categories')->select('name','slug')->get();
      $job = DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->join('employers', 'jobs.employer_id', 'employers.id')
                            ->select('jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
                            ->where('jobs.status', '=', 1)
                            ->paginate(8);
      return view('job-list',compact('jobcategory', 'job'));
    }
    
    public function filterCategory($slug)
    {
        $jobcategory = DB::table('job_categories')->select('name','slug')->get();
        $where_pending = [
          'job_categories.slug' => $slug,
          'jobs.status' => '1',
      ];
        $job = DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->join('employers', 'jobs.employer_id', 'employers.id')
                            ->select('jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
                            ->where($where_pending)
                            ->paginate(8);
      return view('job-list',compact('jobcategory', 'job'));

    }
}
