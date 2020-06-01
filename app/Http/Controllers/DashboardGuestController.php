<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Student;
use App\Job;
use App\Employer;
use App\Seminar;

class DashboardGuestController extends Controller
{
    public function getListJasa(Request $request)
    {
        $where = [
            'guest_id' => $request->session()->get('id'),
        ];

        $services = DB::table('guest_services')
                    ->join('guests', 'guest_services.guest_id', 'guests.id')
                    ->join('services', 'guest_services.service_id', 'services.id')
                    ->join('students', 'services.student_id', 'students.id')
                    ->where($where)
                    ->select('guest_services.status_pekerjaan', 'guest_services.updated_at', 'students.name as stdname', 'services.name as servname', 'guest_services.status')
                    ->paginate(20);
        // dd($services);

        return view('dashboard.pages.guest.list-jasa')->with('services', $services);
    }
}
