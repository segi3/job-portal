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
use App\IYTBatch;
use App\LaporanProgresBulanan;
use App\LaporanKontrolBulanan;
use App\LaporanKemajuan;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Session;

class DashboardIYTController extends Controller
{
    public function getHomeIYT(Request $request) 
    {
        $id = $request->session()->get('id');
        $iyt = DB::table('investasi_iyt')->where('student_id', '=', $id)->first();
        $getyear = explode("-", $iyt->invoice_iyt);
        $year = $getyear[0];
        
        return view('dashboard.pages.iyt.home')->with('iyt', $iyt)->with('year', $year);
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
            $query->where('status','=', '1');
            $query->orderBy('updated_at');
        })
        ->first();
        if($iyt)
            return view('dashboard.pages.student.register-iyt')->with('iyt', $iyt);
        else
            return view('dashboard.pages.student.register-iyt-not-avail');
    }

    public function getRegisterIYTStatus(Request $request)
    {
        $invoice = $request->session()->get('invoice');
        
        // dd($investee);

        if ($invoice == 0 )
            return redirect('dashboard/register-IYT');
        else
            $iyt = DB::table('investasi_iyt')->where('invoice_iyt', '=', $id)->first();
            return view('dashboard.pages.student.register-iyt-status')->with('iyt', $iyt);
    }

    protected function _nextInvoiceIYTNumber()
    {
        // $now = Carbon::now();
        // $year = $now->year;
        $year = IYTBatch::where('status', '=', '1')->first();
        $lastIYT = Investasi_IYT::where('batch_id', '=', $year->batch)->orderBy('invoice_iyt')->first();

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
            'batch'     =>  'required',
            'tahunmasuk'  => 'required|max:4',
            'tahunlulus'   => 'required|max:4',
            'semester'  => 'required',
            'kategori' => 'required',
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
                'tahun_masuk'       => $request->input('tahunmasuk'),
                'tahun_keluar'       => $request->input('tahunlulus'),
                'kategori'       => $request->input('kategori'),
                'semester'         => $request->input('semester'),
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
        // ! masih harus belum fungsional, belum final

        try {
            $berkas_laporan_keuangan = $request->file('berkas-laporan-keuangan');
            $berkas_ext = $berkas_laporan_keuangan->getClientOriginalExtension();

            $target_name = 'asd' . '.' . $berkas_ext; // ! nunggu identifier unik iyt
            // * format nama file = [identifier IYT]-[bulan]-[tahun]-laporan-keuangan.pdf

            $target_location = 'data_files/Student/IYT/Laporan/Progres_Bulanan/Laporan_Keuangan';
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
            return redirect()->back()->withInput();
        }
    }

    public function getSubmitKontrolBulanan()
    {
        return view('dashboard.pages.iyt.laporan.submit-kontrol-bulanan');
    }

    public function postSubmitKontrolBulanan(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'bulan-laporan' => 'required|gt:0',
            'tahun-laporan' => 'required',
            'berkas-laporan-rekapitulasi' => 'required|mimes:pdf',
            'berkas-dokumentasi' => 'mimes:pdf',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }else if ($request->input('indikator-4') == 'Ada' && !$request->file('berkas-dokumentasi')){
            $errorMsg[1] = 'Pilih tidak ada dokumentasi jika tidak mengupload file dokumentasi pada indikator 4';
            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();
        }

        try {
            $berkas_laporan_rekapitulasi = $request->file('berkas-laporan-rekapitulasi');
            $berkas_ext = $berkas_laporan_rekapitulasi->getClientOriginalExtension();

            $target_name_rekapitulasi = 'asd' . '.' . $berkas_ext; //! nunggu identifier unik iyt
            //  * format nama file = [identifier IYT]-[bulan]-[tahun]-laporan-rekapitulasi.pdf

            $target_location_rekapitulasi = 'data_files/Student/IYT/Laporan/Kontrol-Bulanan/Laporan-Rekaptulasi';
            $berkas_laporan_rekapitulasi->move($target_location_rekapitulasi, $target_name_rekapitulasi);

            if($request->file('berkas-dokumentasi')) {
                $berkas_laporan_dokumentasi = $request->file('berkas-laporan-dokumentasi');
                $berkas_ext_dokumentasi = $berkas_laporan_dokumentasi->getClientOriginalExtension();

                $target_name_dokumentasi = 'asd' . '.' . $berkas_ext_dokumentasi;
                // * format nama file = [identifier IYT]-[bulan]-[tahun]-laporan-dokumentasi.pdf

                $target_location_dokumentasi = 'data_files/Student/IYT/Laporan/Kontrol_Bulanan/Laporan-Dokumentasi';
                $berkas_laporan_dokumentasi->move($target_location_dokumentasi, $target_name_dokumentasi);

            }else{
                $target_name_dokumentasi = null;
            }

            // ! asih error engga ada iyt_id
            LaporanKontrolBulanan::create([
                'iyt_id' => '',
                'berkas_laporan_rekapitulasi' => $target_name_rekapitulasi,
                'berkas_laporan_dokumentasi' => $target_name_dokumentasi,
                'bulan' => $request->input('bulan-laporan'),
                'tahun' => $request->input('tahun-laporan'),

                'indikator-1a' => $this->_pisahIndikator($request->input('indikator-1a')),
                'nilai-1a' => $this->_pisahNilai($request->input('indikator-1a')),
                'komentar-1a' => $request->input('komentar-1a'),

                'indikator-1b' => $this->_pisahIndikator($request->input('indikator-1b')),
                'nilai-1b' => $this->_pisahNilai($request->input('indikator-1b')),
                'komentar-1b' => $request->input('komentar-1b'),

                'indikator-2a' => $this->_pisahIndikator($request->input('indikator-2a')),
                'nilai-2a' => $this->_pisahNilai($request->input('indikator-2a')),
                'komentar-2a' => $request->input('komentar-2a'),

                'indikator-2b' => $this->_pisahIndikator($request->input('indikator-2b')),
                'nilai-2b' => $this->_pisahNilai($request->input('indikator-2b')),
                'komentar-2b' => $request->input('komentar-2b'),

                'indikator-2c' => $this->_pisahIndikator($request->input('indikator-2c')),
                'nilai-2c' => $this->_pisahNilai($request->input('indikator-2c')),
                'komentar-2c' => $request->input('komentar-2c'),

                'indikator-2d' => $this->_pisahIndikator($request->input('indikator-2d')),
                'nilai-2d' => $this->_pisahNilai($request->input('indikator-2d')),
                'komentar-2d' => $request->input('komentar-2d'),

                'indikator-3a' => $this->_pisahIndikator($request->input('indikator-3a')),
                'nilai-3a' => $this->_pisahNilai($request->input('indikator-3a')),
                'komentar-3a' => $request->input('komentar-3a'),

                'indikator-3b' => $this->_pisahIndikator($request->input('indikator-3b')),
                'nilai-3b' => $this->_pisahNilai($request->input('indikator-3b')),
                'komentar-3b' => $request->input('komentar-3b'),
            ]);

        }catch(\Illuminate\Database\QueryException $e)
        {
            $errorMsg[1] = $e->errorInfo[2];

            $errorMsg[1] = 'Kode error : '.$e->errorInfo[1];
            $errorMsg[2] = "Terdapat kesalahan dalam database, silahkan input ulang";
            // $errorMsg[3] = $e->errorInfo[2]; 
            // dd($e);
            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();;
        }
    }

    protected function _pisahNilai($string){
        $pisah = explode(".", $string);

        return $pisah[0];
    }

    protected function _pisahIndikator($string){
        $pisah = explode(".", $string);

        return $pisah[1];
    }

    public function getSubmitLaporanKemajuan()
    {
        return view('dashboard.pages.iyt.laporan.submit-laporan-kemajuan');
    }

    public function postSubmitLaporanKemajuan(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'bulan-laporan' => 'required|gt:0',
            'tahun-laporan' => 'required',
            'berkas-laporan-rekapitulasi' => 'required|mimes:pdf',
            'berkas-laporan-kemajuan' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        try {
            // * laporan kemajuan
            $berkas_laporan_kemajuan = $request->file('berkas-laporan-kemajuan');
            $berkas_laporan_kemajuan_extension = $berkas_laporan_kemajuan->getClientOriginalExtension();

            $target_name_kemajuan = 'asd' . '.' . $berkas_laporan_kemajuan_extension;
            $target_location_kemajuan = 'data_files/Student/IYT/Laporan/Laporan_Kemajuan';
            $berkas_laporan_kemajuan->move($target_location_kemajuan, $target_name_kemajuan);

            // * laporan rekapitulasi
            $berkas_laporan_rekapitulasi = $request->file('berkas-laporan-rekapitulasi');
            $berkas_laporan_rekapitulasi_extension = $berkas_laporan_rekapitulasi->getClientOriginalExtension();

            $target_name_rekapitulasi = 'asd' . '.' . $berkas_laporan_rekapitulasi_extension;
            $target_location_rekapitulasi = 'data_files/Student/IYT/Laporan/Laporan_Keuangan';
            $berkas_laporan_rekapitulasi->move($target_location_rekapitulasi, $target_name_rekapitulasi);

            LaporanKemajuan::creaate([
                'iyt_id' => '',
                'bulan' => $request->input('bulan-laporan'),
                'tahun' => $request->input('tahun-laporan'),
                'berkas_laporan_rekapitulasi' => $target_name_rekapitulasi,
                'berkas_laporan_kemajuan' => $target_name_kemajuan,
            ]);


        }catch(\Illuminate\Database\QueryException $e)
        {
            $errorMsg[1] = $e->errorInfo[2];

            $errorMsg[1] = 'Kode error : '.$e->errorInfo[1];
            $errorMsg[2] = "Terdapat kesalahan dalam database, silahkan input ulang";
            // $errorMsg[3] = $e->errorInfo[2]; 
            // dd($e);
            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();;
        }
    }
}
