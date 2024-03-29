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

    public function getCreateIYT(Request $request)
    {

        // $iyt = DB::table('i_y_t_batches')->where('start_date','<', $now)->where('end_date','>', $now)
        //         ->orWhere('start_date','=', $now)->orWhere('end_date','=', $now)
        //         ->get();
        $batch = DB::table('i_y_t_batches')
        ->where(function ($query){
            $now= Carbon::now()->format('Y-m-d');
            $query->where('start_date','<=', $now);
            $query->where('end_date','>=', $now);
            $query->where('status','=', '1');
            $query->orderBy('updated_at');
        })
        ->first();

        $id = $request->session()->get('id');
        $IYT = DB::table('investasi_iyt')
        ->leftjoin('i_y_t_batches', 'i_y_t_batches.id', 'investasi_iyt.batch_id')
        ->where('i_y_t_batches.status', '=', '1')
        ->where('investasi_iyt.student_id', '=', $id)
        ->select('*', 'investasi_iyt.id as iyt_id')
        ->first();

        if($IYT){
            return redirect('dashboard/register-IYT-status');
        }
        else{
            if($batch){
                return view('dashboard.pages.student.register-iyt')->with('batch', $batch);
            }
            else{
                return view('dashboard.pages.student.register-iyt-not-avail');
            }
        }
    }

    public function getRegisterIYTStatus(Request $request)
    {
        $id = $request->session()->get('id');

        $IYT = DB::table('investasi_iyt')
        ->leftjoin('i_y_t_batches', 'i_y_t_batches.id', 'investasi_iyt.batch_id')
        ->where('i_y_t_batches.status', '=', '1')
        ->where('investasi_iyt.student_id', '=', $id)
        ->select('*', 'investasi_iyt.id as iyt_id', 'investasi_iyt.status as status_iyt')
        ->first();

        // dd($investee);

        if ($IYT){
            if($IYT->status_iyt == 1){
                return redirect('dashboard/IYT');
            }
            else
            {
                $iyt = DB::table('investasi_iyt')->where('id', '=', $IYT->iyt_id)->first();
                return view('dashboard.pages.student.register-iyt-status')->with('iyt', $iyt);
            }
        }
        else{
            return redirect('dashboard/register-IYT');
        }
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
        // dd($request);

        $input = $request->all();

        $validator = Validator::make($input, [
            'bulan-laporan' => 'required|gt:0',
            'tahun-laporan' => 'required',
            'berkas-laporan-keuangan' => 'required|mimes:pdf',
            'berkas-kwitansi' => 'required|mimes:pdf'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        $identifier_iyt = $request->session()->get('invoice');
        $bulan_laporan = $request->input('bulan-laporan');
        $tahun_laporan = $request->input('tahun-laporan');

        // ! cek laporan untuk bulan dan tahun exist atau engga
        $laporan_exist = LaporanProgresBulanan::where([
            'iyt_invoice' => $identifier_iyt,
            'bulan' => $bulan_laporan,
            'tahun' => $tahun_laporan,
        ])->first();

        if ($laporan_exist != null) {
            $errorMsg[1] = 'Laporan untuk bulan '. $bulan_laporan .' dan tahun '. $tahun_laporan .' sudah ada';

            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();
        }

        try {
            $berkas_laporan_keuangan = $request->file('berkas-laporan-keuangan');
            $berkas_ext = $berkas_laporan_keuangan->getClientOriginalExtension();

            $target_name = $identifier_iyt . '-b' . $bulan_laporan . '-t' . $tahun_laporan . '-laporan-keuangan.' . $berkas_ext;
            // * format nama file = [identifier IYT]-[bulan]-[tahun]-laporan-keuangan.pdf

            $target_location = 'data_files/Student/IYT/Laporan/Progres_Bulanan/Laporan_Keuangan';
            $berkas_laporan_keuangan->move($target_location, $target_name);

            $berkas_kwitansi = $request->file('berkas-kwitansi');
            $berkas_kwitansi_ext = $berkas_kwitansi->getClientOriginalExtension();

            // * format nama file = [identifier iyt]-[bulan]-[tahun]-kwitansi.pdf
            $target_kwitansi_name = $identifier_iyt . '-b' . $bulan_laporan . '-t' . $tahun_laporan . '-kwitansi.' . $berkas_kwitansi_ext;

            $target_kwitansi_location = 'data_files/Student/IYT/Laporan/Progres_Bulanan/Kwitansi';
            $berkas_kwitansi->move($target_kwitansi_location, $target_kwitansi_name);

            LaporanProgresBulanan::create([
                'iyt_invoice' => $identifier_iyt,
                'berkas_laporan_keuangan' => $target_name,
                'berkas_kwitansi' => $target_kwitansi_name,
                'bulan' => $bulan_laporan,
                'tahun' => $tahun_laporan,

                'indikator_1a' => $request->input('indikator-1a'),
                'indikator_1b' => $request->input('indikator-1b'),
                'indikator_1c' => $request->input('indikator-1c'),

                'indikator_2a' => $request->input('indikator-2a'),
                'indikator_2b' => $request->input('indikator-2b'),
                'indikator_2c' => $request->input('indikator-2c'),

                'indikator_3a' => $request->input('indikator-3a'),
                'indikator_3b' => $request->input('indikator-3b'),
                'indikator_3c' => $request->input('indikator-3c'),

                'indikator_4a' => $request->input('indikator-4a'),
                'indikator_4b' => $request->input('indikator-4b'),
                'indikator_4c' => $request->input('indikator-4c'),

                'indikator_5a' => $request->input('indikator-5a'),
                'indikator_5b' => $request->input('indikator-5b'),
                'indikator_5c' => $request->input('indikator-5c'),

                'indikator_6a' => $request->input('indikator-6a'),
                'indikator_6b' => $request->input('indikator-6b'),
                'indikator_6c' => $request->input('indikator-6c'),

                'indikator_7a' => $request->input('indikator-7a'),
                'indikator_7b' => $request->input('indikator-7b'),
                'indikator_7c' => $request->input('indikator-7c'),

                'indikator_8a' => $request->input('indikator-8a'),
                'indikator_8b' => $request->input('indikator-8b'),
                'indikator_8c' => $request->input('indikator-8c'),

                'indikator_9a' => $request->input('indikator-9a'),
                'indikator_9b' => $request->input('indikator-9b'),
                'indikator_9c' => $request->input('indikator-9c'),

                'indikator_10a' => $request->input('indikator-10a'),
                'indikator_10b' => $request->input('indikator-10b'),
                'indikator_10c' => $request->input('indikator-10c'),

                'indikator_11a' => $request->input('indikator-11a'),
                'indikator_11b' => $request->input('indikator-11b'),
                'indikator_11c' => $request->input('indikator-11c'),

                'indikator_12a' => $request->input('indikator-12a'),
                'indikator_12b' => $request->input('indikator-12b'),
                'indikator_12c' => $request->input('indikator-12c'),

                'indikator_13a' => $request->input('indikator-13a'),
                'indikator_13b' => $request->input('indikator-13b'),
                'indikator_13c' => $request->input('indikator-13c'),

                'indikator_14a' => $request->input('indikator-14a'),
                'indikator_14b' => $request->input('indikator-14b'),
                'indikator_14c' => $request->input('indikator-14c'),

                'indikator_15a' => $request->input('indikator-15a'),
                'indikator_15b' => $request->input('indikator-15b'),
                'indikator_15c' => $request->input('indikator-15c'),

                'indikator_16a' => $request->input('indikator-16a'),
                'indikator_16b' => $request->input('indikator-16b'),
                'indikator_16c' => $request->input('indikator-16c'),

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
        // dd($request);

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

        $identifier_iyt = $request->session()->get('invoice');
        $bulan_laporan = $request->input('bulan-laporan');
        $tahun_laporan = $request->input('tahun-laporan');

        // ! cek laporan untuk bulan dan tahun exist atau engga
        $laporan_exist = LaporanKontrolBulanan::where([
            'iyt_invoice' => $identifier_iyt,
            'bulan' => $bulan_laporan,
            'tahun' => $tahun_laporan,
        ])->first();

        if ($laporan_exist != null) {
            $errorMsg[1] = 'Laporan untuk bulan '. $bulan_laporan .' dan tahun '. $tahun_laporan .' sudah ada';

            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();
        }

        try {
            $berkas_laporan_rekapitulasi = $request->file('berkas-laporan-rekapitulasi');
            $berkas_ext = $berkas_laporan_rekapitulasi->getClientOriginalExtension();

            $target_name_rekapitulasi = $identifier_iyt . '-b' . $bulan_laporan . '-t' . $tahun_laporan . '-laporan-rekapitulasi.' . $berkas_ext;
            //  * format nama file = [identifier IYT]-[bulan]-[tahun]-laporan-rekapitulasi.pdf

            $target_location_rekapitulasi = 'data_files/Student/IYT/Laporan/Kontrol_Bulanan/Laporan_Rekapitulasi';
            $berkas_laporan_rekapitulasi->move($target_location_rekapitulasi, $target_name_rekapitulasi);

            if($request->file('berkas-dokumentasi')) {
                $berkas_laporan_dokumentasi = $request->file('berkas-dokumentasi');
                $berkas_ext_dokumentasi = $berkas_laporan_dokumentasi->getClientOriginalExtension();

                $target_name_dokumentasi = $identifier_iyt . '-b' . $bulan_laporan . '-t' . $tahun_laporan . '-laporan-dokumentasi.' . $berkas_ext_dokumentasi;
                // * format nama file = [identifier IYT]-[bulan]-[tahun]-laporan-dokumentasi.pdf

                $target_location_dokumentasi = 'data_files/Student/IYT/Laporan/Kontrol_Bulanan/Laporan_Dokumentasi';
                $berkas_laporan_dokumentasi->move($target_location_dokumentasi, $target_name_dokumentasi);

            }else{
                $target_name_dokumentasi = null;
            }

            // ! asih error engga ada iyt_id, 2020-1 itu placeholder doang
            LaporanKontrolBulanan::create([
                'iyt_invoice' => $identifier_iyt,
                'berkas_laporan_rekapitulasi' => $target_name_rekapitulasi,
                'berkas_laporan_dokumentasi' => $target_name_dokumentasi,
                'bulan' => $bulan_laporan,
                'tahun' => $tahun_laporan,

                'indikator_1a' => $this->_pisahIndikator($request->input('indikator-1a')),
                'nilai_1a' => $this->_pisahNilai($request->input('indikator-1a')),
                'komentar_1a' => $request->input('komentar-1a'),

                'indikator_1b' => $this->_pisahIndikator($request->input('indikator-1b')),
                'nilai_1b' => $this->_pisahNilai($request->input('indikator-1b')),
                'komentar_1b' => $request->input('komentar-1b'),

                'indikator_2a' => $this->_pisahIndikator($request->input('indikator-2a')),
                'nilai_2a' => $this->_pisahNilai($request->input('indikator-2a')),
                'komentar_2a' => $request->input('komentar-2a'),

                'indikator_2b' => $this->_pisahIndikator($request->input('indikator-2b')),
                'nilai_2b' => $this->_pisahNilai($request->input('indikator-2b')),
                'komentar_2b' => $request->input('komentar-2b'),

                'indikator_2c' => $this->_pisahIndikator($request->input('indikator-2c')),
                'nilai_2c' => $this->_pisahNilai($request->input('indikator-2c')),
                'komentar_2c' => $request->input('komentar-2c'),

                'indikator_2d' => $this->_pisahIndikator($request->input('indikator-2d')),
                'nilai_2d' => $this->_pisahNilai($request->input('indikator-2d')),
                'komentar_2d' => $request->input('komentar-2d'),

                'indikator_3a' => $this->_pisahIndikator($request->input('indikator-3a')),
                'nilai_3a' => $this->_pisahNilai($request->input('indikator-3a')),
                'komentar_3a' => $request->input('komentar-3a'),

                'indikator_3b' => $this->_pisahIndikator($request->input('indikator-3b')),
                'nilai_3b' => $this->_pisahNilai($request->input('indikator-3b')),
                'komentar_3b' => $request->input('komentar-3b'),
            ]);

            Session::flash('success', 'Laporan berhasil di submit');
            return redirect()->back();

        }catch(\Illuminate\Database\QueryException $e)
        {
            $errorMsg[1] = $e->errorInfo[2];

            $errorMsg[1] = 'Kode error : '.$e->errorInfo[1];
            $errorMsg[2] = "Terdapat kesalahan dalam database, silahkan input ulang";
            $errorMsg[3] = $e->errorInfo[2];
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

        $identifier_iyt = $request->session()->get('invoice');
        $bulan_laporan = $request->input('bulan-laporan');
        $tahun_laporan = $request->input('tahun-laporan');

        // ! cek laporan untuk bu;an dan tahun exist atau engga
        $laporan_exist = LaporanKemajuan::where([
            'iyt_invoice' => $identifier_iyt,
            'bulan' => $bulan_laporan,
            'tahun' => $tahun_laporan,
        ])->first();

        if ($laporan_exist != null) {
            $errorMsg[1] = 'Laporan untuk bulan '. $bulan_laporan .' dan tahun '. $tahun_laporan .' sudah ada';

            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();
        }

        try {
            // * laporan kemajuan
            $berkas_laporan_kemajuan = $request->file('berkas-laporan-kemajuan');
            $berkas_laporan_kemajuan_extension = $berkas_laporan_kemajuan->getClientOriginalExtension();

            $target_name_kemajuan = $identifier_iyt . '-b' . $bulan_laporan . '-t' . $tahun_laporan . '-laporan-kemajuan.' . $berkas_laporan_kemajuan_extension;
            $target_location_kemajuan = 'data_files/Student/IYT/Laporan/Laporan_Kemajuan';
            $berkas_laporan_kemajuan->move($target_location_kemajuan, $target_name_kemajuan);

            // * laporan rekapitulasi
            $berkas_laporan_rekapitulasi = $request->file('berkas-laporan-rekapitulasi');
            $berkas_laporan_rekapitulasi_extension = $berkas_laporan_rekapitulasi->getClientOriginalExtension();

            $target_name_rekapitulasi = $identifier_iyt . '-b' . $bulan_laporan . '-t' . $tahun_laporan . '-laporan-rekapitulasi.' . $berkas_laporan_rekapitulasi_extension;
            $target_location_rekapitulasi = 'data_files/Student/IYT/Laporan/Laporan_Kemajuan/Laporan_Rekapitulasi';
            $berkas_laporan_rekapitulasi->move($target_location_rekapitulasi, $target_name_rekapitulasi);

            LaporanKemajuan::create([
                'iyt_invoice' => $identifier_iyt,
                'bulan' => $bulan_laporan,
                'tahun' => $tahun_laporan,
                'berkas_laporan_rekapitulasi' => $target_name_rekapitulasi,
                'berkas_laporan_kemajuan' => $target_name_kemajuan,
            ]);

            Session::flash('success', 'Laporan berhasil di submit');
            return redirect()->back();


        }catch(\Illuminate\Database\QueryException $e)
        {
            $errorMsg[1] = $e->errorInfo[2];

            $errorMsg[1] = 'Kode error : '.$e->errorInfo[1];
            $errorMsg[2] = "Terdapat kesalahan dalam database, silahkan input ulang";
            // $errorMsg[3] = $e->errorInfo[2];
            // dd($e);
            Session::flash('error', $errorMsg);
            return redirect()->back()->withInput();
        }
    }

    public function downloadTempateCoverKeuangan()
    {
        // dd('download cover keuangan');

        $file = public_path('data_files/Student/IYT/COVER-LAP-KEUANGAN.docx');
        return response()->download($file, 'COVER LAPORAN KEUANGAN.docx');

    }

    public function downloadTemplateRekap()
    {
        // dd('download template rekapitulasi');

        $file = public_path('data_files/Student/IYT/REKAPITULASI.docx');
        return response()->download($file, 'TEMPLATE REKAPITULASI.docx');
    }

    public function downloadTemplateKemajuan()
    {
        $file = public_path('data_files/Student/IYT/FORMAT-KEMAJUAN-6-BULAN.docx');
        return response()->download($file, 'LAPORAN KEMAJUAN.docx');
    }


}
