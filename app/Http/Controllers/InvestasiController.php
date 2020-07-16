<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Session;
use Validator;

use App\Student;
use App\Investasi;
use App\Investasi_project;


class InvestasiController extends Controller
{
    public function showProjectIndex()
    {
        $investasiCount = DB::table('investasi_project')
                        ->where('status', '=', 1)
                        ->count();

        $investasi = DB::table('investasi_project')
                        ->join('investee', 'investee.id', 'investasi_project.investee_id')
                        ->select('investasi_project.*', 'investee.nama as nama_investee')
                        ->where('investasi_project.status', '=', 1)
                        ->paginate(8);

        return view('investasi-project-list')->with('investasis', $investasi)->with('investasiCount', $investasiCount);
    }

    public function detailProject($id)
    {
        $where = [
            'investasi_project.id' => $id,
            'investasi_project.status' => 1,
        ];

        $investasi = DB::table('investasi_project')
                        ->join('investee', 'investee.id', 'investasi_project.investee_id')
                        ->select('investasi_project.*', 'investee.nama as nama_investee')
                        ->where($where)
                        ->first();
        // dd($investasi);

        return view('investasi-project-detail')->with('investasi', $investasi);
    }

    public function beliSaham(Request $request, $id_inv)
    {

        // cek jumlah lembar yang tersedia
        $investasi = Investasi_project::find($id_inv);
        $lembar_sisa = $investasi->lembar_total - $investasi->lembar_terbeli;
        if ($request->input('lembar_beli') > $lembar_sisa){
            Session::flash('error', 'Tidak dapat membeli sebanyak '.$request->input('lembar_beli').', hanya tersisa '.$lembar_sisa.' lembar');
            return redirect()->back();
        }

        $id_student = $request->session()->get('id');

        $validator = Validator::make($request->all(),[
            'lembar_beli' => 'required',
            'termspolicy' => 'required',
        ]);

        if ($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        if ($request->session()->get('role') == 'student'){
            //order student
        }else if ($request->session()->get('role') == 'guest'){
            //order guest
        }

        dd($request); // dilanjut pake api midtrans

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
