<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services;
use App\JobCategory;
use App\Students;

class ServicesController extends Controller
{
    public function index()
    {
        $servicesCount= DB::table('services')
                        ->where('services.status','=',1)
                        ->count();
        $jobcategory = DB::table('job_categories')
                    ->select('name','slug')->get();
        $services = DB::table('services')
                    ->join('students','services.student_id','students.id')
                    ->join('job_categories', 'services.job_category_id' ,'job_categories.id')
                    ->select('services.id as id','services.name as name', 'students.name as penyedia','job_categories.name as category','services.updated_at as lastupdate')
                    ->where('services.status','=',1)
                    ->paginate(8);
        return view('services-list',compact('servicesCount','jobcategory','services'));
    }
    public function filterServicesCategory($slug)
    {
        $jobcategory = DB::table('job_categories')
                    ->select('name','slug')->get();
        $where_pending = [
          'job_categories.slug' => $slug,
          'services.status' => '1'
        ];

        $services = DB::table('services')
                    ->join('students','services.student_id','students.id')
                    ->join('job_categories', 'services.job_category_id' ,'job_categories.id')
                    ->select('services.id as id','services.name as name', 'students.name as penyedia','job_categories.name as category','services.updated_at as lastupdate')
                    ->where($where_pending)
                    ->paginate(2);
        $servicesCount= DB::table('services')
                    ->join('students','services.student_id','students.id')
                    ->join('job_categories', 'services.job_category_id' ,'job_categories.id')
                    ->where($where_pending)
                    ->count();
        return view('services-list',compact('servicesCount','jobcategory','services'));
    }

    public function detailServices($slug)
    {
        $where_pending = [
            'services.id' => $slug,
            'services.status' => '1'
          ];

          $servData= DB::table('services')
          ->join('students','services.student_id','students.id')
          ->join('job_categories', 'services.job_category_id' ,'job_categories.id')
          ->select(   'services.name as servname',//a
                      'services.description as desc',//a
                      'services.updated_at as lastupdate',
                      'students.name as studentName', //a
                      'students.nrp as nrp', //a
                      'students.mobile_no as nohp', //a
                      'students.email as email', //a
                      'students.hobby as hobby',
                      'students.skill as skill',
                      'students.achievment as achievment',
                      'students.experience as expe',
                      'students.gender as gender', //a
                      'students.city as city',//a
                      'students.province as prov',//a
                      'students.id as stud_id',
                      'services.id as id'
                  )
          ->where($where_pending)
          ->get();
        $dataku=$servData->first();
        $where_success = [
            'services.status' => '1',
            'guest_services.status_pekerjaan'=>'1',
            'students.id'=>$dataku->stud_id,
        ];
        $servicesCount= DB::table('guest_services')
          ->join('services','services.id','guest_services.id')
          ->join('students', 'students.id' ,'services.student_id')
          ->where($where_success)
          ->count();

        return view('services-detail',compact('servData','servicesCount'));

    }
    public function approach(Request $request, $id)
    {

      $id_guest = $request->session()->get('id');
      $applicant = DB::table('guest_services')->where([
        ['service_id', '=', $id],
        ['guest_id', '=', $id_guest]
      ])->first();
      if($applicant)
      {
          Session::flash('error', 'Sudah anda approach!');
          return redirect()->back();
      }
      else
      {
        try
        {
          $data = array(
            array(
            'guest_id'=> $id_guest,
            'service_id'=> $id,
            'status' => 0,
            'status_pekerjaan'=>0,
            ),
         );
          DB::table('guest_services')->insert($data);
          Session::flash('success', 'Berhasil apply job');
          return redirect('/');
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



}
