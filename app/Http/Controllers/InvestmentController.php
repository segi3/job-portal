<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Job;
use App\Employer;
use App\Guest;
use App\Seminar;
use App\Service;
use App\Investasi;
use App\Investee;


class InvestmentController extends Controller
{
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
            $employerid= $request->session()->get('id');
            $employername = $request->session()->get('name');
            $tujuaninv = 'data_files/investee/Non-IYT/Project/proposal_investasi';
            $tujuankeu = 'data_files/investee/Non-IYT/Project/lap_keu';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "Investment_".$employerid.md5('_INV_'.$employername.'_'.$request->input('description')).'.'.$extension;
            $filenamekeu= "Keuangan_".$employerid.md5('_KEU_'.$employername.'_'.$request->input('description')).'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkasinvestasi->move($tujuaninv,$filenameinv);
            $berkaskeuangan->move($tujuankeu,$filenamekeu);
            $formatDate = \Carbon\Carbon::parse($request->input('duedate'))->format('Y-m-d');
        try{
            Investasi::create([
                'nama_investasi'        => $request->input('namainvestasi'),
                'employer_id'           => $request->session()->get('id'),
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
            $employerid= $request->session()->get('id');
            $employername = $request->session()->get('name');
            $tujuaninv = 'data_files/investee/Non-IYT/Funding/proposal_investasi';
            $tujuankeu = 'data_files/investee/Non-IYT/Funding/lap_keu';
            $extension= 'pdf';
            // $desc= md5($request->input('description'));
            $filenameinv= "Investment_".$employerid.md5('_INV_'.$employername.'_'.$request->input('description')).'.'.$extension;
            $filenamekeu= "Keuangan_".$employerid.md5('_KEU_'.$employername.'_'.$request->input('description')).'.'.$extension;
            // $berkas->move($tujuan,$filename);
            $berkasinvestasi->move($tujuaninv,$filenameinv);
            $berkaskeuangan->move($tujuankeu,$filenamekeu);
            $formatDate = \Carbon\Carbon::parse($request->input('duedate'))->format('Y-m-d');
        try{
            Investasi::create([
                'nama_investasi'        => $request->input('namainvestasi'),
                'employer_id'           => $request->session()->get('id'),
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
