<?php

namespace App\Http\Controllers;

use App\iyt_mentoring;
use App\Notulensi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use App\LaporanKontrolBulanan;

class IytMentoringController extends Controller
{
    public function showCreateMentoring()
    {
        return view('dashboard.pages.mentor.create-iyt-mentoring');
    }

    public function createMentoring(Request $request)
    {


        $formatDate = \Carbon\Carbon::parse($request->input('birthday'))->format('Y-m-d');

        $validator = Validator::make($request->all(), [
            'judul'         => 'required',
            'tanggal'       => [
                                'required',
                                'after_or_equal:' . date('d-m-Y'), // not 'now' string
                                ],
            'link'        => 'required'

        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }
        $batch = DB::table('i_y_t_batches')
                    ->select('id')
                    ->where('status','=', 1)
                    ->first();
        $iyts = DB::table('investasi_iyt')
                    ->select('id')
                    ->where('status','=', '1')
                    ->where('batch_id', '=', $batch->id)
                    ->get();

        try {
            $formatDate = \Carbon\Carbon::parse($request->input('tanggal'))->format('Y-m-d');
            $data = iyt_mentoring::create([
                'judul'         => $request->input('judul'),
                'tgl_mentoring' => $formatDate,
                'link'          => $request->input('link'),
                'batch_id'      => $batch->id,
                'mentor_id'     => $request->session()->get('id'),
            ]);
            $mentoring_id = $data->id;
            foreach($iyts as $iyt )
            {
                Notulensi::create([
                    'mentoring_id'  => $mentoring_id,
                    'iyt_id'        => $iyt->id,
                ]);
            }
            Session::flash('success', 'Mentoring berhasil dijadwalkan');
            // return view('dashboard.pages.mentor.create-iyt-mentoring');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return view('dashboard.pages.mentor.create-iyt-mentoring');
        }
    }

    public function showIYTNotulensi(Request $request)
    {
        $iytid=$request->session()->get('invoice');

        $mentorings = DB::table('notulensi')
                    ->join('iyt_mentorings','iyt_mentorings.id','=','notulensi.mentoring_id')
                    ->join('mentors','iyt_mentorings.mentor_id','=','mentors.id')
                    ->join('investasi_iyt','notulensi.iyt_id','=','investasi_iyt.id')
                    ->select('*','notulensi.id as notulensi_id')
                    ->where('investasi_iyt.invoice_iyt','=',$iytid)
                    ->paginate(10);

        // dd($mentorings);
        // return view('dashboard.pages.iyt.notulensi.iyt-notulensi');
        return view('dashboard.pages.iyt.notulensi.iyt-notulensi', compact('mentorings'));
    }

    public function downloadDokumentasi($idmentoring)
    {
        $where = [
            'notulensi.id' => $idmentoring,
        ];

        $berkas_db = DB::table('notulensi')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/IYT/Mentoring/Dokumentasi/'.$berkas_db->dokumentasi);
        return response()->download($file, $berkas_db->dokumentasi);

    }

    public function uploadDokumentasi($idmentoring, Request $request){
        // dd($idmentoring);
        $where = [
            'notulensi.id' => $idmentoring,
        ];

        $this->validate($request, [

            'dokumentasi' => 'required|mimes:pdf|max:4096'
        ]);

        $dokumentasi=$request->file('dokumentasi');
        $tujuan = 'data_files/Student/IYT/Mentoring/Dokumentasi/';
        $extension= $dokumentasi->getClientOriginalExtension();
        $filename= md5($idmentoring).'.'.$extension;
        // dd($filename);
        $dokumentasi->move($tujuan,$filename);

        $acc = DB::table('notulensi')
                    ->where($where)
                    ->update([
                        'dokumentasi' => $filename,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }

    public function showListPeserta()
    {
        $iyts= DB::table('investasi_iyt')
                    ->join('i_y_t_batches','i_y_t_batches.id','=','investasi_iyt.batch_id')
                    ->select('*')
                    ->where('investasi_iyt.status','=','1')
                    ->where('i_y_t_batches.status','=',1)
                    ->paginate(10);

        return view('dashboard.pages.mentor.list-peserta')->with('iyts',$iyts);
    }

    public function showListMentoring()
    {
        $schedules= DB::table('iyt_mentorings')
                    ->join('i_y_t_batches','i_y_t_batches.id','=','iyt_mentorings.batch_id')
                    ->select('*')
                    ->where('i_y_t_batches.status','=',1)
                    ->paginate(10);

        return view('dashboard.pages.mentor.list-jadwal')->with('schedules',$schedules);
    }

    public function showDetailPeserta($id, Request $request)
    {

        $iyt= DB::table('investasi_iyt')
                    ->join('i_y_t_batches','i_y_t_batches.id','=','investasi_iyt.batch_id')
                    ->select('investasi_iyt.*','i_y_t_batches.batch')
                    ->where('investasi_iyt.status','=',1)
                    ->where('investasi_iyt.id','=', $id)
                    ->first();
        $ment_id = $request->session()->get('id');
        $mentorings = DB::table('iyt_mentorings')
                    ->join('mentors','iyt_mentorings.mentor_id','=','mentors.id')
                    ->join('notulensi','iyt_mentorings.id','=','notulensi.mentoring_id')
                    ->join('investasi_iyt','investasi_iyt.id','=','notulensi.iyt_id')
                    ->join('i_y_t_batches', 'i_y_t_batches.id', '=','iyt_mentorings.batch_id')
                    ->select('i_y_t_batches.*','mentors.name', 'iyt_mentorings.*', 'notulensi.*','notulensi.id as notulensi_id')
                    ->where('notulensi.iyt_id','=',$id)
                    ->where('i_y_t_batches.status','=',1)
                    ->where('mentors.id','=', $ment_id)
                    ->paginate(10, ['*'], 'mentorings');
        // $mentorings->setPageName('mentorings_page');

        $progress =  DB::table('laporan_bulanan')
                    ->select('*')
                    ->where('iyt_invoice','=',$iyt->invoice_iyt)
                    ->paginate(10, ['*'], 'laporan_bulanan');
        // $progress->setPageName('progress_page');

        $kontrol =  DB::table('laporan_kontrol_bulanan')
                    ->select('*')
                    ->where('iyt_invoice','=',$iyt->invoice_iyt)
                    ->paginate(10, ['*'], 'laporan_kontrol_bulanan');
        // $kontrol->setPageName('kontrol_page');
        $kemajuan =  DB::table('laporan_kemajuan')
                    ->select('*')
                    ->where('iyt_invoice','=',$iyt->invoice_iyt)
                    ->paginate(10, ['*'], 'laporan_kemajuan');
        // $kemajuan->setPageName('kemajuan_page');
        return view('dashboard.pages.mentor.detail-peserta')->with('iyt',$iyt)->with('mentorings',$mentorings)->with('progress',$progress)->with('kontrol',$kontrol)->with('kemajuan',$kemajuan);
    }

    public function postComment(Request $request, $id)
    {
        // dd($request->input('komentar'));
        $input = $request->all();
        $validator = Validator::make($input, [
            'komentar'  => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }
        try {
            $mentor_id = $request->session()->get('id');
            $iyt= Notulensi::where('id','=', $id)->first();
            $iyt->komentar = $request->input('komentar');
            $iyt->save();
            Session::flash('success', 'Komentar berhasil ditambahkan');
            // return view('dashboard.pages.mentor.create-iyt-mentoring');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return redirect()->back();
        }
    }
    public function postNotulensi(Request $request, $id)
    {
        // dd($request->input('komentar'));
        $input = $request->all();
        $validator = Validator::make($input, [
            'notulensi'  => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }
        try {
            $iyt= Notulensi::where('id','=', $id)->first();
            $iyt->notulensi = $request->input('notulensi');
            $iyt->save();
            Session::flash('success', 'Notulensi berhasil ditambahkan');
            // return view('dashboard.pages.mentor.create-iyt-mentoring');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return redirect()->back();
        }
    }
    public function editComment(Request $request, $id)
    {
        dd($id);
        // $input = $request->all();
        // $validator = Validator::make($input, [
        //     'komentar'  => 'required|max:255',
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', $validator->errors());
        //     return redirect()->back()->withInput();
        // }
        // try {
        //     $mentor_id = $request->session()->get('id');
        //     $iyt= iyt_mentoring::where('mentor_id','=',$mentor_id)->where('id','=', $id)->first();
        //     $iyt->komentar = $request->input('komentar');
        //     $iyt->save();
        //     Session::flash('success', 'Komentar berhasil ditambahkan');
        //     return redirect()->back();
        // }
        // catch(\Illuminate\Database\QueryException $e)
        // {
        //     $errorCode = $e->errorInfo[1];
        //     if ($errorCode == 1062) {
        //         return redirect('/');
        //     }
        //     Session::flash('error', $errorCode);
        //     return redirect()->back();
        // }
    }

    protected function _numToMonth($month)
    {
        $string = '';

        switch($month){
            case 1:
                $string = 'Januari'; break;
            case 2:
                $string = 'Februari'; break;
            case 3:
                $string = 'Maret'; break;
            case 4:
                $string = 'April'; break;
            case 5:
                $string = 'Mei'; break;
            case 6:
                $string = 'Juni'; break;
            case 7:
                $string = 'Juli'; break;
            case 8:
                $string = 'Agustus'; break;
            case 9:
                $string = 'September'; break;
            case 10:
                $string = 'Oktober'; break;
            case 11:
                $string = 'November'; break;
            case 12:
                $string = 'Desember'; break;
        }

        return $string;

    }

    public function getLaporanBulanan($id)
    {
        $where_laporan = [
            'laporan_bulanan.id' => $id
        ];

        $progres_bulanan = DB::table('laporan_bulanan')
                            ->where($where_laporan)
                            ->first();

        $progres_bulanan->bulan = $this->_numToMonth($progres_bulanan->bulan);


        $where_iyt = [
            'investasi_iyt.invoice_iyt' => $progres_bulanan->iyt_invoice
        ];

        $kelompok_iyt = DB::table('investasi_iyt')
                        ->where($where_iyt)
                        ->first();


        // dd($kelompok_iyt);

        // dd($progres_bulanan);

        return view('dashboard.pages.iyt.laporan.view-laporan-bulanan')->with('laporan', $progres_bulanan)->with('data_kelompok', $kelompok_iyt);
    }

    public function getKontrolBulanan($id)
    {
        $where_laporan = [
            'laporan_kontrol_bulanan.id' => $id
        ];

        $kontrol_bulanan = DB::table('laporan_kontrol_bulanan')
                            ->where($where_laporan)
                            ->first();

        $kontrol_bulanan->bulan = $this->_numToMonth($kontrol_bulanan->bulan);

        $kontrol_bulanan->alasan_reviewer = explode("|", $kontrol_bulanan->alasan_reviewer);

        // dd($kontrol_bulanan->alasan_reviewer);

        // dd($kontrol_bulanan);

        $where_iyt = [
            'investasi_iyt.invoice_iyt' => $kontrol_bulanan->iyt_invoice
        ];

        $kelompok_iyt = DB::table('investasi_iyt')
                        ->where($where_iyt)
                        ->first();

        $where_mentor = [
            'mentors.id' => $kontrol_bulanan->mentor_id
        ];

        $mentor = DB::table('mentors')->where($where_mentor)->first();

        // dd($mentor);

        return view('dashboard.pages.iyt.laporan.view-kontrol-bulanan')
                ->with('laporan', $kontrol_bulanan)
                ->with('data_kelompok', $kelompok_iyt)
                ->with('mentor', $mentor);
    }

    public function updateKontrolBulanan(Request $request)
    {
        $alasan = $request->input('alasan_reviewer');
        $string_alasan = '';

        // * nge gabung array alasan jadi satu
        $last_key = array_search(end($alasan), $alasan);
        foreach ($alasan as $poin => $value){
            if ($poin == $last_key) {
                $string_alasan = $string_alasan . $value;
            }else {
                $string_alasan = $string_alasan . $value . '|';
            }

        };

        try{
            $laporan = LaporanKontrolBulanan::find($request->input('laporan_id'));

            $laporan->rekomendasi_reviewer = $request->input('rekomendasi-reviewer');
            $laporan->alasan_reviewer = $string_alasan;
            $laporan->mentor_id = $request->session()->get('id');

            $laporan->save();

            Session::flash('success', 'Berhasil update rekomendasi');
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
    public function downloadLaporanBulanan($namaBerkas)
    {
        $file = public_path('data_files/Student/IYT/Laporan/Progres_Bulanan/Laporan_Keuangan/'.$namaBerkas);
        return response()->download($file, $namaBerkas);
    }

    public function downloadLaporanKontrolDokumentasi($namaBerkas)
    {
        $file = public_path('data_files/Student/IYT/Laporan/Kontrol_Bulanan/Laporan_Dokumentasi/'.$namaBerkas);
        return response()->download($file, $namaBerkas);
    }

    public function downloadLaporanKontrolRekapitulasi($namaBerkas)
    {
        $file = public_path('data_files/Student/IYT/Laporan/Kontrol_Bulanan/Laporan_Rekapitulasi/'.$namaBerkas);
        return response()->download($file, $namaBerkas);
    }

    public function downloadLaporanKemajuanRekapitulasi($namaBerkas)
    {
        $file = public_path('data_files/Student/IYT/Laporan/Laporan_Kemajuan/Laporan_Rekapitulasi/'.$namaBerkas);
        return response()->download($file, $namaBerkas);
    }

    public function downloadLaporanKemajuanKemajuan($namaBerkas)
    {
        $file = public_path('data_files/Student/IYT/Laporan/Laporan_Kemajuan/'.$namaBerkas);
        return response()->download($file, $namaBerkas);
    }



}
