<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Investee;
use App\Investasi_project;
use App\Investasi_funding;
use App\Investasi_IYT;
use App\Student;

use Session;

class DashboardIYTController extends Controller
{
    public function getHomeIYT() {
        return view('dashboard.pages.iyt.home');
    }

    public function getCreateIYT()
    {
        return view('dashboard.pages.iyt.create-iyt');
    }

    public function postCreateIYT(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
            'namaketua' => 'required|max:191',
            'namakelompok'      => 'required|max:191',
            'proposalbisnis'   => 'required|mimes:pdf|max:2048',
            'pitchdesk'   => 'required|mimes:pdf|max:2048',
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

        try{
            $berkaspropbisnis= $request->file('proposalbisnis');
            $berkaspitchdesk= $request->file('pitchdesk');
            $studentid= $request->session()->get('id');
            $investeeid = DB::table('investee')
                        ->select('investee.id')        
                        ->where('student_id', '=', $studentid)
                        ->Where('status', '=', '1')
                        ->first();
            $studentname = $request->session()->get('name');
            $propbisnishash = md5('_PROPOSALBISNIS_'.$studentname.'_'.$request->input('namakelompok'));
            $pitchdeskhash = md5('_PITCHDESK_'.$studentname.'_'.$request->input('namakelompok'));
            $tujuaninv = 'data_files/investee/IYT/Proposal Bisnis';
            $tujuankeu = 'data_files/investee/IYT/Pitch Desk';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "ProposalBisnis_".$studentid.$investeeid->id.$propbisnishash.'.'.$extension;
            $filenamekeu= "PitchDesk_".$studentid.$investeeid->id.$pitchdeskhash.'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkaspropbisnis->move($tujuaninv,$filenameinv);
            $berkaspitchdesk->move($tujuankeu,$filenamekeu);

            Investasi_IYT::create([
                'nama_ketua'        => $request->input('namaketua'),
                'investee_id'           => $investeeid->id,
                'status'                => 0,
                'nama_kelompok'         => $request->input('namakelompok'),
                'berkas_proposal_bisnis'=> $filenameinv,
                'berkas_pitch_desk'  => $filenamekeu,
            ]);

            Session::flash('success', 'Kelompok berhasil didaftarkan dan akan diseleksi, silahkan tunggu hasil pengumuman dari pihak admin');
            return view('dashboard.pages.iyt.create-iyt');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorMsg);
            return view('dashboard.pages.iyt.create-iyt');
        }
    }
}
