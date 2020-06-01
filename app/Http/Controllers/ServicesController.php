<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    ->paginate(2);
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
                                'students.id as id'
                            )
                    ->where($where_pending)
                    ->get();
        return view('services-detail',compact('servData'));

    }



}
