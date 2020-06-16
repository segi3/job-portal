<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Session;
use Validator;

use App\Student;
use App\Investasi;


class InvestasiController extends Controller
{
    public function index()
    {
        $investasiCount = DB::table('investasi')
                        ->where('status', '=', 1)
                        ->count();

        $investasi = DB::table('investasi')
                        ->join('employers', 'investasi.employer_id', 'employers.id')
                        ->select('investasi.*', 'employers.name as employername')
                        ->where('investasi.status', '=', 1)
                        ->paginate(8);

        return view('investasi-list')->with('investasis', $investasi)->with('investasiCount', $investasiCount);
    }

    public function detail($id)
    {
        $where = [
            'investasi.id' => $id,
            'investasi.status' => '1'
        ];

        $investasi = DB::table('investasi')
                        ->join('employers', 'investasi.employer_id', 'employers.id')
                        ->select('investasi.*', 'employers.name as employername')
                        ->where($where)
                        ->first();
        // dd($investasi);

        return view('investasi-detail')->with('investasi', $investasi);
    }

    public function beliSaham(Request $request, $id_inv)
    {
        // cek jumlah lembar yang tersedia
        $investasi = Investasi::find($id_inv);
        $lembar_sisa = $investasi->lembar_total - $investasi->lembar_terbeli;
        if ($request->input('lembar_beli') > $lembar_sisa){
            Session::flash('error', 'Tidak dapat membeli sebanyak '.$request->input('lembar_beli').', hanya tersisa '.$lembar_sisa.' lembar');
            return redirect()->back();
        }

        $id_student = $request->session()->get('id');

        $validator = Validator::make($request->all(),[
            'lembar_beli' => 'required',
            'berkas' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        // berkas ktp
        $student = Student::find($id_student);

        $file = $request->file('berkas');
        $file_ktp = 'ktp-'.$id_student.'-'.$id_inv.'-'.$student->name.'.pdf';
        $tujuan_upload = 'data_files/KTP';
        $file->move($tujuan_upload, $file_ktp);

        //tanggal deadline
        $duedate = new \DateTime('+2 day');
        $duedate->format('Y-m-d');

        try{
            $data = [
                'student_id' => $id_student,
                'investasi_id' => $id_inv,
                'status_bayar' => '0',
                'status_uang_balik' => '2',
                'lembar_beli' => $request->input('lembar_beli'),
                'berkas_ktp' => $file_ktp,
                'berkas_bukti_pembayaran' => 'belum upload',
                'expired_at' => $duedate->format('Y-m-d'),
                'updated_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
            ];
            DB::table('investasi_student')->insert($data);
            Session::flash('success', 'Silahkan segera upload bukti transfer sebelum tanggal '.$duedate->format('Y-m-d').' pukul 24.00');
            return redirect()->back();
        }catch(\Illuminate\Database\QueryException $e)
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
