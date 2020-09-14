<?php

namespace App\Http\Controllers;

use App\iyt_mentoring;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;

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
            'kelompok'        => 'required'

        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }
        try {
            $formatDate = \Carbon\Carbon::parse($request->input('tanggal'))->format('Y-m-d');
            iyt_mentoring::create([
                'judul'         => $request->input('judul'),
                'tgl_mentoring' => $formatDate,
                'investasi_iyt_id' => $request->input('kelompok'),
                'mentor_id'     => $request->session()->get('id'),

            ]);
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
        $iytid=$request->session()->get('iyt-data')->id;

        $mentorings = DB::table('iyt_mentorings')
                    ->join('mentors','iyt_mentorings.mentor_id','=','mentors.id')
                    ->join('investasi_iyt','iyt_mentorings.investasi_iyt_id','=','investasi_iyt.id')
                    ->select('*','iyt_mentorings.id as mentoring_id')
                    ->where('investasi_iyt_id','=',$iytid)
                    ->paginate(10);

        // dd($mentorings);
        // return view('dashboard.pages.iyt.notulensi.iyt-notulensi');
        return view('dashboard.pages.iyt.notulensi.iyt-notulensi', compact('mentorings','iytid'));
    }

    public function downloadDokumentasi($idmentoring)
    {
        $where = [
            'iyt_mentorings.id' => $idmentoring,
        ];

        $berkas_db = DB::table('iyt_mentorings')
        ->where($where)
        ->first();
        $file = public_path('data_files/Student/IYT/Mentoring/Dokumentasi/'.$berkas_db->dokumentasi);
        return response()->download($file, $berkas_db->dokumentasi);
        
    }

    public function uploadDokumentasi($idmentoring, Request $request){
        // dd($idmentoring);
        $where = [
            'iyt_mentorings.id' => $idmentoring,
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

        $acc = DB::table('iyt_mentorings')
                    ->where($where)
                    ->update([
                        'dokumentasi' => $filename,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

        return redirect()->back();
    }


}
