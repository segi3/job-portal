<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Investee;

use Session;

class DashboardInvesteeController extends Controller
{
    public function showRegister(Request $request)
    {
        $id = $request->session()->get('id');

        $student = DB::table('students')->find($id);

        // dd($student);

        return view('dashboard.pages.student.register-investee')->with('student', $student);
    }

    public function getRegisterStatus(Request $request)
    {
        $id = $request->session()->get('id');

        $investee = DB::table('investee')->where('student_id', '=', $id)->first();

        // dd($investee);

        if ($investee)
            return view('dashboard.pages.student.register-investee-status')->with('investee', $investee);
        else
            return redirect('dashboard/register-investee');
    }

    public function registerNew(Request $request)
    {
        // dd($request);
        $id = $request->session()->get('id');
        $student = DB::table('students')->find($id);

        $investeeCheck = DB::table('investee')->where('student_id', '=', $id)->first();

        if ($investeeCheck){
            Session::flash('error', 'Akun Investee sudah didaftarkan');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'province'      => 'required',
            'contact_person' => 'required',
            'contact_no'    => 'required',
        ]);

        if ($validator->fails()) {
            // Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }

        

        try{
            Investee::create([
                'student_id'        => $student->id,
                'nama'              => $request->input('name'),
                'address'           => $request->input('address'),
                'city'              => $request->input('city'),
                'province'          => $request->input('province'),
                'fax'               => $request->input('fax'),
                'contact_person'    => $request->input('contact_person'),
                'contact_no'        => $request->input('contact_no'),
                'email'             => $student->email,
                'fax'               => $request->input('fax'),
            ]);

            Session::flash('success', 'Akun berhasil didaftarkan');
            return redirect('dashboard/register-status');
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
