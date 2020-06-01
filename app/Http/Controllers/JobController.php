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
                            ->select('jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
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
                            ->select('jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername')
                            ->where($where_pending)
                            ->paginate(8);
      return view('job-list',compact('jobcategory', 'job'));

    }

    public function detail($id)
    {
      $job= Job::where('id',$id)->first();
		  return view('job-detail',['job' => $job]);
    }

    public function apply(Request $request, $id)
    {
      $this->validate($request, [
        'cv' => 'required|mimes:pdf|max:2048',
        'motlet' => 'required',
      ]);
   
      $file = $request->file('cv');
      $id_stud = $request->session()->get('id');
      $id_job = $id;
      $file_cv = $id_stud.' '.$
      $tujuan_upload = 'CV';
      $file->move($tujuan_upload,$file->getClientOriginalName());

      try {
        $data = array(
          array(
          'student_id'=> $id_stud, 
          'job_id'=> $id_job, 
          'cv'=> $file_cv,  
          'motivation_letter'=> $request->get('motlet')),
       );
        DB::table('job_student')->insert($data);
        Session::flash('success', 'Berhasil apply job');
        return view('/');
    }
    catch(\Illuminate\Database\QueryException $e)
    {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            return redirect('/');
        }
        Session::flash('error', $errorCode);
        return redirect()->back();
    }
    }
}
