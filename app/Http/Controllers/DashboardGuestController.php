<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Order;

class DashboardGuestController extends Controller
{
    public function getListJasa(Request $request)
    {
        $where = [
            'guest_id' => $request->session()->get('id'),
            'guest_services.status'=>0,
        ];

        $services = DB::table('guest_services')
                    ->join('guests', 'guest_services.guest_id', 'guests.id')
                    ->join('services', 'guest_services.service_id', 'services.id')
                    ->join('students', 'services.student_id', 'students.id')
                    ->where($where)
                    ->select('services.id as id','guest_services.status_pekerjaan', 'guest_services.updated_at', 'students.name as stdname', 'services.name as servname', 'guest_services.status')
                    ->paginate(20);
        // dd($services);

        return view('dashboard.pages.guest.list-jasa')->with('services', $services);
    }
    public function getListJasaRejected(Request $request)
    {
        $where = [
            'guest_id' => $request->session()->get('id'),
            'guest_services.status'=>2,
        ];

        $services = DB::table('guest_services')
                    ->join('guests', 'guest_services.guest_id', 'guests.id')
                    ->join('services', 'guest_services.service_id', 'services.id')
                    ->join('students', 'services.student_id', 'students.id')
                    ->where($where)
                    ->select('services.id as id','guest_services.status_pekerjaan', 'guest_services.updated_at', 'students.name as stdname', 'services.name as servname', 'guest_services.status')
                    ->paginate(20);
        // dd($services);

        return view('dashboard.pages.guest.list-jasa-rejected')->with('services', $services);
    }
    public function getListJasaDone(Request $request)
    {
        $where = [
            'guest_id' => $request->session()->get('id'),
            'guest_services.status_pekerjaan'=>1,
            'guest_services.status'=>1,
        ];

        $services = DB::table('guest_services')
                    ->join('guests', 'guest_services.guest_id', 'guests.id')
                    ->join('services', 'guest_services.service_id', 'services.id')
                    ->join('students', 'services.student_id', 'students.id')
                    ->where($where)
                    ->select('services.id as id','guest_services.status_pekerjaan', 'guest_services.updated_at', 'students.name as stdname', 'services.name as servname', 'guest_services.status')
                    ->paginate(20);
        // dd($services);

        return view('dashboard.pages.guest.list-jasa-done')->with('services', $services);
    }
    public function getListJasaInprogress(Request $request)
    {
        $where = [
            'guest_id' => $request->session()->get('id'),
            'guest_services.status_pekerjaan'=>0,
            'guest_services.status'=>1,
        ];

        $services = DB::table('guest_services')
                    ->join('guests', 'guest_services.guest_id', 'guests.id')
                    ->join('services', 'guest_services.service_id', 'services.id')
                    ->join('students', 'services.student_id', 'students.id')
                    ->where($where)
                    ->select('services.id as id','guest_services.status_pekerjaan', 'guest_services.updated_at', 'students.name as stdname', 'services.name as servname', 'guest_services.status')
                    ->paginate(20);
        // dd($services);

        return view('dashboard.pages.guest.list-jasa-inprogress')->with('services', $services);
    }
    public function doneServices(Request $request, $id)
    {

        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status_pekerjaan' => 1,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }

    public function notdoneServices(Request $request, $id)
    {
        $acc = DB::table('guest_services')
                    ->where('id', $id)
                    ->update([
                        'status_pekerjaan' => 0,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }

    public function getOrderList(Request $request)
    {
        $where = [
            'id_investor' => $request->session()->get('id'),
            'role' => $request->session()->get('role'),
        ];

        $orders = Order::where($where)->orderBy('updated_at', 'desc')->paginate(25);

        return view('dashboard.pages.order-list')->with('orders', $orders);
    }
    public function showProjectListStudent(Request $request)
    {
        $guestid= $request->session()->get('id');
        $investment = DB::table('order')
                        ->select('order.*')
                        ->where('order.id_investor', '=', $guestid)
                        ->where('role', '=', 'guest')
                        ->where('status', '=', 'paid')
                        ->where('tipe_investasi', '=', 'project')
                        ->paginate(25);
        return view('dashboard.pages.guest.on-going-project-list')->with('investment', $investment);
    }
    public function showDetailInvestment(Request $request, $id)
    {
        $guestid= $request->session()->get('id');
        $order = DB::table('order')
                    ->select('order.id_investee')        
                    ->where('id_investor', '=', $guestid)
                    ->where('status', '=', 'paid')
                    ->where('role', '=', 'guest')
                    ->where('id_investasi', '=', $id)
                    ->where('tipe_investasi', '=', 'project')
                    ->first();
        $investee = DB::table('investee')
                    ->select('investee.*')
                    ->where('id', '=', $order->id_investee)
                    ->first();    
        $investment = DB::table('investasi_project')
                    ->select('investasi_project.*') 
                    ->where('investasi_project.id', '=', $id)
                    ->first();
        $listprogres = DB::table('progres_project')
                        -> select('progres_project.*')
                        -> where('progres_project.project_id','=', $id)
                        -> orderByRaw('tgl DESC')
                        ->paginate(8);
        return view('dashboard.pages.guest.detail-investment',compact('investee','listprogres','investment'));
    }
}
