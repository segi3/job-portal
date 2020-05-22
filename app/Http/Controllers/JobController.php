<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobCategory;


class JobController extends Controller
{
    public function index()
    {
		$jobcategory = JobCategory::all();
		return view('job-list')->with('jobcategory', $jobcategory);;
    }
    
    public function filterCategory($category_name)
    {
        $jobcategory = JobCategory::where('name', $category_name);
        $job = Job::where('job_category_id',$jobcategory->id)->paginate(6);

    }
}
