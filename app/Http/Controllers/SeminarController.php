<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Seminar;
use App\SeminarCategory;
use App\Employer;

class SeminarController extends Controller
{
    public function index()
    {
      $Count= DB::table('seminars')
                        ->where('seminars.status','=',1)
                        ->count();

      $seminarcategory = DB::table('seminar_categories')->select('name','slug')->get();

      $seminar = DB::table('seminars')
                            ->join('seminar_categories', 'seminars.seminar_category_id' ,'seminar_categories.id')
                            ->join('employers', 'seminars.employer_id', 'employers.id')
                            ->select('seminars.fee' , 'seminars.id as id','seminars.name as name','seminars.location as location', 'employers.name as employername', 'employers.logo as emplogo')
                            ->where('seminars.status', '=', 1)
                            ->paginate(8);
      
                            // dd($job);

      return view('seminar-list')->with('seminar', $seminar)->with('Count', $Count)->with('seminarcategory', $seminarcategory);
    }
    
    public function filterCategory($slug)
    {
      
        $seminarcategory = DB::table('seminar_categories')->select('name','slug')->get();
        $where_pending = [
          'seminar_categories.slug' => $slug,
          'seminars.status' => '1',
      ];
      $Count= DB::table('seminars')
                        ->join('seminar_categories', 'seminars.seminar_category_id' ,'seminar_categories.id')
                        ->where($where_pending)
                        ->count();
        $job = DB::table('seminars')
        ->join('seminar_categories', 'seminars.seminar_category_id' ,'seminar_categories.id')
        ->join('employers', 'seminars.employer_id', 'employers.id')
        ->select('seminars.fee' , 'seminars.id as id','seminars.name as name','seminars.location as location', 'employers.name as employername', 'employers.logo as emplogo')
                            ->where($where_pending)
                            ->paginate(8);
      return view('seminar-list',compact('seminarcategory', 'seminar','Count'));

    }

    public function detail($id)
    {
      $seminar= Seminar::where('seminars.id',$id)
            ->join('employers', 'seminars.employer_id', 'employers.id')
            ->select('seminars.*', 'employers.logo as logo', 'employers.name as empname', 'employers.address as empaddress', 'employers.city as empcity', 'employers.province as empprov', 'employers.website as empweb')
            ->first();
      // dd($job);
		  return view('seminar-detail',['seminar' => $seminar]);
    }
}
