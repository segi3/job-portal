<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Investee;
use App\Investasi_project;
use App\Investasi_funding;
use App\Student;

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
    public function getCreateProjInvestment()
    {
        return view('dashboard.pages.investee.create-project-investment');
    }

    public function postCreateProjInvestment(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
            'namainvestasi' => 'required|max:191',
            'description'   => 'required',
            'namabank'      => 'required|max:191',
            'nomorrekening' => 'required|numeric',
            'atasnama'      => 'required|max:191',
            'hargaperlembar' => 'required|numeric',
            'totallembar' => 'required|numeric|min: 1',
            'roi_d'         => 'required|numeric',
            'roi_u'         => 'required|numeric|gt:roi_d',
            'duedate'       => 'required|date',
            'proposalinvestasi'   => 'required|mimes:pdf|max:2048',
            'laporankeuangan'   => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        // $this->validate($request, [
        //     'description'   => 'required',
        //     'namabank'      => 'required',
        //     'nomorrekening' => 'required|numeric',
        //     'hargaperlembar' => 'required|numeric',
        //     'totallembar' => 'required|numeric|min: 1',
        //     'roi_d'         => 'required|numeric',
        //     'roi_u'         => 'required|numeric|gt:roi_d',
        //     'duedate'       => 'required|date',
        //     'proposalinvestasi'   => 'required|mimes:pdf|max:2048',
        //     'laporankeuangan'   => 'required|mimes:pdf|max:2048',
        //     'termpolicy'        => 'required',
        // ]);

            $berkasinvestasi= $request->file('proposalinvestasi');
            $berkaskeuangan= $request->file('laporankeuangan');
            $studentid= $request->session()->get('id');
            $investeeid = DB::table('investee')
                        ->select('investee.id')        
                        ->where('investee.student_id','=', $studentid)
                        ->Where('investee.status', '=','1')
                        ->first();
            $studentname = $request->session()->get('name');
            $tujuaninv = 'data_files/investee/Non-IYT/Project/proposal_investasi';
            $tujuankeu = 'data_files/investee/Non-IYT/Project/lap_keu';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "Investment_".$studentid.$investeeid.md5('_INV_'.$studentname.'_'.$request->input('description')).'.'.$extension;
            $filenamekeu= "Keuangan_".$studentid.$investeeid.md5('_KEU_'.$studentname.'_'.$request->input('description')).'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkasinvestasi->move($tujuaninv,$filenameinv);
            $berkaskeuangan->move($tujuankeu,$filenamekeu);
            $formatDate = \Carbon\Carbon::parse($request->input('duedate'))->format('Y-m-d');
        try{
            Investasi_project::create([
                'nama_investasi'        => $request->input('namainvestasi'),
                'investee_id'           => $investeeid,
                'status'                => 0,
                'status_tempo'          => 0,
                'bank'                  => $request->input('namabank'),
                'no_rekening'           => $request->input('nomorrekening'),
                'atas_nama'             => $request->input('atasnama'),
                'deskripsi_bisnis'      => $request->input('description'),
                'roi_top'               => $request->input('roi_u'),
                'roi_bot'               => $request->input('roi_d'),
                'lembar_total'          => $request->input('totallembar'),
                'lembar_terbeli'        => 0,
                'harga_saham'           => $request->input('hargaperlembar'),
                'tgl_jatuh_tempo'       => $formatDate,
                'berkas_proposal_investasi'  => $filenameinv,
                'berkas_laporan_keuangan'  => $filenamekeu,
            ]);

            Session::flash('success', 'Investasi berhasil didaftarkan, silahkan tunggu konfirmasi dari pihak admin');
            return view('dashboard.pages.investee.create-project-investment');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.investee.create-project-investment');
        }
    }
    public function getCreateFundInvestment()
    {
        return view('dashboard.pages.investee.create-funding-investment');
    }

    public function postCreateFundInvestment(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
            'namainvestasi' => 'required|max:191',
            'description'   => 'required',
            'namabank'      => 'required|max:191',
            'nomorrekening' => 'required|numeric',
            'atasnama'      => 'required|max:191',
            'targetdana' => 'required|numeric',
            'duedate'       => 'required|date',
            'proposalinvestasi'   => 'required|mimes:pdf|max:2048',
            'laporankeuangan'   => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        // $this->validate($request, [
        //     'description'   => 'required',
        //     'namabank'      => 'required',
        //     'nomorrekening' => 'required|numeric',
        //     'hargaperlembar' => 'required|numeric',
        //     'totallembar' => 'required|numeric|min: 1',
        //     'roi_d'         => 'required|numeric',
        //     'roi_u'         => 'required|numeric|gt:roi_d',
        //     'duedate'       => 'required|date',
        //     'proposalinvestasi'   => 'required|mimes:pdf|max:2048',
        //     'laporankeuangan'   => 'required|mimes:pdf|max:2048',
        //     'termpolicy'        => 'required',
        // ]);

            $berkasinvestasi= $request->file('proposalinvestasi');
            $berkaskeuangan= $request->file('laporankeuangan');
            $studentid= $request->session()->get('id');
            $investeeid = DB::table('investee')
                        ->select('investee.id')        
                        ->where('student_id', '=', $studentid)
                        ->Where('status', '=', '1')
                        ->first();
            $studentname = $request->session()->get('name');
            $tujuaninv = 'data_files/investee/Non-IYT/Funding/proposal_investasi';
            $tujuankeu = 'data_files/investee/Non-IYT/Funding/lap_keu';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "Investment_".$studentid.$investeeid.md5('_INV_'.$studentname.'_'.$request->input('description')).'.'.$extension;
            $filenamekeu= "Keuangan_".$studentid.$investeeid.md5('_KEU_'.$studentname.'_'.$request->input('description')).'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkasinvestasi->move($tujuaninv,$filenameinv);
            $berkaskeuangan->move($tujuankeu,$filenamekeu);
            $formatDate = \Carbon\Carbon::parse($request->input('duedate'))->format('Y-m-d');
        try{
            Investasi_funding::create([
                'nama_investasi'        => $request->input('namainvestasi'),
                'investee_id'           => $investeeid,
                'status'                => 0,
                'status_tempo'          => 0,
                'bank'                  => $request->input('namabank'),
                'no_rekening'           => $request->input('nomorrekening'),
                'atas_nama'             => $request->input('atasnama'),
                'deskripsi_bisnis'      => $request->input('description'),
                'target'           => $request->input('targetdana'),
                'tgl_jatuh_tempo'       => $formatDate,
                'berkas_proposal_investasi'  => $filenameinv,
                'berkas_laporan_keuangan'  => $filenamekeu,
            ]);

            Session::flash('success', 'Investasi berhasil didaftarkan, silahkan tunggu konfirmasi dari pihak admin');
            return view('dashboard.pages.investee.create-funding-investment');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.investee.create-funding-investment');
        }
    }
    
}
