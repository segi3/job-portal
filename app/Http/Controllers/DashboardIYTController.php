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
use App\LaporanProgresBulanan;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Session;

class DashboardIYTController extends Controller
{
    public function getHomeIYT(Request $request) 
    {
        $id = $request->session()->get('id');
        $iyt = DB::table('investasi_iyt')->where('student_id', '=', $id)->first();
        return view('dashboard.pages.iyt.home')->with('iyt', $iyt);
    }

    public function getCreateIYT()
    {

        // $iyt = DB::table('i_y_t_batches')->where('start_date','<', $now)->where('end_date','>', $now)
        //         ->orWhere('start_date','=', $now)->orWhere('end_date','=', $now)
        //         ->get();
        $iyt = DB::table('i_y_t_batches')
        ->where(function ($query){
            $now= Carbon::now()->format('Y-m-d');
            $query->where('start_date','<=', $now);
            $query->where('end_date','>=', $now);
        })
        ->get();
        return view('dashboard.pages.student.register-iyt')->with('iyt', $iyt);
    }

    public function getRegisterIYTStatus(Request $request)
    {
        $id = $request->session()->get('id');

        $iyt = DB::table('investasi_iyt')->where('student_id', '=', $id)->first();

        // dd($investee);

        if ($iyt)
            return view('dashboard.pages.student.register-iyt-status')->with('iyt', $iyt);
        else
            return redirect('dashboard/register-IYT');
    }

    protected function _nextInvoiceIYTNumber()
    {
        $now = Carbon::now();
        $year = $now->year;
        $lastIYT = Investasi_IYT::whereYear('created_at', '=', $year)->orderBy('created_at', 'desc')->first();

        if($lastIYT) {

            $lastInvoice = explode("-", $lastIYT->invoice_iyt);

            return $lastInvoice[1] + 1;
        }else {
            return 1;
        }
    }

    public function postCreateIYT(Request $request){

        $input = $request->all();
        $id = $request->session()->get('id');
        $student = DB::table('students')->find($id);

        $iytCheck = DB::table('investasi_iyt')->where('student_id', '=', $id)->first();

        if ($iytCheck){
            Session::flash('error', 'Akun Investee sudah didaftarkan');
            return redirect()->back();
        }

        $validator = Validator::make($input, [
            'namaketua' => 'required|max:191',
            'namakelompok'      => 'required|max:191',
            'proposalbisnis'   => 'required|mimes:pdf|max:2048',
            'pitchdesk'   => 'required|mimes:pdf|max:2048',
            'batch'     =>  'required'
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
        // dd($request->input('batch'));
        try{
            $berkaspropbisnis= $request->file('proposalbisnis');
            $berkaspitchdesk= $request->file('pitchdesk');
            $studentname = $request->session()->get('name');
            $propbisnishash = md5('_PROPOSALBISNIS_'.$studentname.'_'.$request->input('namakelompok'));
            $pitchdeskhash = md5('_PITCHDESK_'.$studentname.'_'.$request->input('namakelompok'));
            $tujuaninv = 'data_files/Student/IYT/Proposal Bisnis';
            $tujuankeu = 'data_files/Student/IYT/Pitch Desk';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "ProposalBisnis_".$student->id.$propbisnishash.'.'.$extension;
            $filenamekeu= "PitchDesk_".$student->id.$pitchdeskhash.'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkaspropbisnis->move($tujuaninv,$filenameinv);
            $berkaspitchdesk->move($tujuankeu,$filenamekeu);
            
            $now = Carbon::now();
            $year = $now->year;
            $no = $this->_nextInvoiceIYTNumber();
            $id_iyt = $year.'-'.$no;


            Investasi_IYT::create([
                'nama_ketua'        => $request->input('namaketua'),
                'student_id'           => $student->id,
                'status'                => 0,
                'nama_kelompok'         => $request->input('namakelompok'),
                'berkas_proposal_bisnis'=> $filenameinv,
                'berkas_pitch_desk'  => $filenamekeu,
                'batch_id'          => $request->input('batch'),
                'invoice_iyt'       => $id_iyt,
            ]);

            Session::flash('success', 'Kelompok berhasil didaftarkan dan akan diseleksi, silahkan tunggu hasil pengumuman dari pihak admin');
            return redirect('dashboard/register-IYT-status');
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

    public function getSubmitLaporanBulanan()
    {
        return view('dashboard.pages.iyt.laporan.submit-laporan-bulanan');
    }

    public function postSubmitLaporanBulanan(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'bulan-laporan' => 'required|gt:0',
            'tahun-laporan' => 'required',
            'berkas-laporan-keuangan' => 'required|mimes:pdf',
        ]);
        
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        // dd($request->session()->get('name'));

        // ! masih harus belum fungsional, belum final

        try {
            $berkas_laporan_keuangan = $request->file('berkas-laporan-keuangan');
            $berkas_ext = $berkas_laporan_keuangan->getClientOriginalExtension();
            $target_name = "asd.pdf"; // ! nunggu identifier unik iyt
            // * format nama file = [identifier IYT]-[bulan]-[tahun]-progres-bulanan.pdf
            $target_location = 'data_files/Student/IYT/Laporan/Progres_Bulanan';
            $berkas_laporan_keuangan->move($target_location, $target_name);

            LaporanProgresBulanan::create([
                'iyt_id' => '',
                'berkas_laporan_keuangan' => $target_name,
                'bulan' => $request->input('bulan-laporan'),
                'tahun' => $request->input('tahun-laporan'),

                '1a' => $request->input('indikator-1a'),
                '1b' => $request->input('indikator-1b'),
                '1c' => $request->input('indikator-1c'),

                '2a' => $request->input('indikator-2a'),
                '2b' => $request->input('indikator-2b'),
                '2c' => $request->input('indikator-2c'),

                '3a' => $request->input('indikator-3a'),
                '3b' => $request->input('indikator-3b'),
                '3c' => $request->input('indikator-3c'),

                '4a' => $request->input('indikator-4a'),
                '4b' => $request->input('indikator-4b'),
                '4c' => $request->input('indikator-4c'),

                '5a' => $request->input('indikator-5a'),
                '5b' => $request->input('indikator-5b'),
                '5c' => $request->input('indikator-5c'),

                '6a' => $request->input('indikator-6a'),
                '6b' => $request->input('indikator-6b'),
                '6c' => $request->input('indikator-6c'),

                '7a' => $request->input('indikator-7a'),
                '7b' => $request->input('indikator-7b'),
                '7c' => $request->input('indikator-7c'),

                '8a' => $request->input('indikator-8a'),
                '8b' => $request->input('indikator-8b'),
                '8c' => $request->input('indikator-8c'),

                '9a' => $request->input('indikator-9a'),
                '9b' => $request->input('indikator-9b'),
                '9c' => $request->input('indikator-9c'),

                '10a' => $request->input('indikator-10a'),
                '10b' => $request->input('indikator-10b'),
                '10c' => $request->input('indikator-10c'),

                '11a' => $request->input('indikator-11a'),
                '11b' => $request->input('indikator-11b'),
                '11c' => $request->input('indikator-11c'),

                '12a' => $request->input('indikator-12a'),
                '12b' => $request->input('indikator-12b'),
                '12c' => $request->input('indikator-12c'),

                '13a' => $request->input('indikator-13a'),
                '13b' => $request->input('indikator-13b'),
                '13c' => $request->input('indikator-13c'),

                '14a' => $request->input('indikator-14a'),
                '14b' => $request->input('indikator-14b'),
                '14c' => $request->input('indikator-14c'),

                '15a' => $request->input('indikator-15a'),
                '15b' => $request->input('indikator-15b'),
                '15c' => $request->input('indikator-15c'),

                '16a' => $request->input('indikator-16a'),
                '16b' => $request->input('indikator-16b'),
                '16c' => $request->input('indikator-16c'),

            ]);

            Session::flash('success', 'Laporan berhasil di submit');
            return redirect()->back();
        }catch(\Illuminate\Database\QueryException $e)
        {
            $errorMsg[1] = $e->errorInfo[2];

            $errorMsg[1] = 'Kode error : '.$e->errorInfo[1];
            $errorMsg[2] = "Terdapat kesalahan dalam database, silahkan input ulang";
            // dd($e);
            Session::flash('error', $errorMsg);
            return redirect()->back();
        }
    }
}
