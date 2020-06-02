<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Job;
use App\JobCategory;
use App\Employer;


class JobController extends Controller
{
    public function index()
    {
      $jobsCount= DB::table('jobs')
                        ->where('jobs.status','=',1)
                        ->count();

      $jobcategory = DB::table('job_categories')->select('name','slug')->get();
      $job = DB::table('jobs')
                            ->join('job_categories', 'jobs.job_category_id' ,'job_categories.id')
                            ->join('employers', 'jobs.employer_id', 'employers.id')
                            ->select('jobs.expected_salary_high', 'jobs.expected_salary_low', 'jobs.id as id','jobs.name as name' , 'jobs.job_type as job_type','jobs.location as location', 'employers.name as employername', 'employers.logo')
                            ->where('jobs.status', '=', 1)
                            ->paginate(8);
      return view('job-list',compact('jobcategory', 'job', 'jobsCount'));
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
      $job= Job::where('jobs.id',$id)
            ->join('employers', 'jobs.employer_id', 'employers.id')
            ->select('jobs.*', 'employers.logo as logo', 'employers.name as empname', 'employers.address as empaddress', 'employers.city as empcity', 'employers.province as empprov', 'employers.website as empweb')
            ->first();
      // dd($job);
		  return view('job-detail',['job' => $job]);
    }

    public function apply(Request $request, $id)
    {
      
      $id_stud = $request->session()->get('id');
      $applicant = DB::table('job_student')->where([
        ['job_id', '=', $id],
        ['student_id', '=', $id_stud],
      ])->first();
      
      // dd($applicant);

      if($applicant)
      {
          Session::flash('error', 'Pekerjaan tidak dapat di apply lebih dari satu kali');
          return redirect()->back();
      }
      else
      {
        $this->validate($request, [
          'cv' => 'required|mimes:pdf|max:2048',
          'motlet' => 'required',
        ]);
        $file = $request->file('cv');
        $cv = 'cv';
        $file_cv = $cv.'-'.$id_stud.'-'.$id.'.pdf';
        $tujuan_upload = 'data_files/CV';
        $file->move($tujuan_upload,$file_cv);
        try 
        {
          $data = array(
            array(
            'student_id'=> $id_stud, 
            'job_id'=> $id, 
            'status' => 0,
            'cv'=> $file_cv,  
            'motivation_letter'=> $request->get('motlet'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()),
         );
          DB::table('job_student')->insert($data);
          Session::flash('success', 'Berhasil apply job');
          return redirect()->back();
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
    }

    
    public function downloadCV($cv)
    {
      // dd($cv);

      $file = public_path('data_files\\CV\\'.$cv.'.pdf');

      $arr = explode('-', $cv);

      // dd($arr);

      $where = [
        'job_student.student_id' => $arr[1],
        'job_student.job_id'     => $arr[2],
      ];

      $cv_name = DB::table('job_student')
                  ->join('students', 'job_student.student_id', 'students.id')
                  ->join('jobs', 'job_student.job_id', 'jobs.id')
                  ->select('students.name as stdname', 'jobs.name as jobname')
                  ->where($where)
                  ->first();
      
      // dd($cv_name);

      // dd($file);
      // $headers = [
      //   'Content-Type: application/pdf',
      // ];

      return response()->download($file, $cv_name->jobname.'-'.$cv_name->stdname.'.pdf');
    }
}
