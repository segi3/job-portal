<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;
use App\Guest;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function showLogin()
    {
        return view('pages.guest.auth.login-guest');
    }
    public function downloadBerkas($berkas)
    {

      $where = [
          'guests.id' => $berkas,
        //   'job_student.job_id'     => $arr[2],
      ];

      $berkas_db = DB::table('guests')
      ->select('guests.name as name', 'guests.email as email', 'guests.berkas_verifikasi as berkas')
      ->where($where)
      ->first();

    //   $pdfname= str_replace(' ','_',$berkas_db->name).'_'.md5($berkas_db->email).'.pdf';

    //   $file = public_path('data_files/bukti_guests/'.$pdfname);
        $file = public_path('data_files/bukti_guests/'.$berkas_db->berkas);
      return response()->download($file, $berkas_db->berkas);
    }

    public function Login(Request $request)
    {
        $guest = Guest::where('email', '=', $request->input('email'))->first();

        if ($guest) {
            if($guest->status_gs == 1){
                if (Hash::check($request->input('password'), $guest->password)) {
                    $request->session()->put([
                        'login' => true,
                        'id' => $guest->id,
                        'name' => $guest->name,
                        'email' => $guest->email,
                        'role' => 'guest',
                    ]);
    
                    Session::flash('success', 'Anda berhasil login');
                    return redirect('/dashboard');
                }else{
                    Session::flash('error', 'Password tidak cocok');
                    return redirect()->route('guest.showLogin');
                }
            }else if ($guest->status_gs == 0){
                return view('pages.employer.login-warning');
            }else if ($guest->status_gs == 2) {
                return view('pages.employer.login-reject');
            }
            
        }else{
            Session::flash('error', 'Akun tidak ditemukan');
            return redirect()->route('guest.showLogin');
        }
    }

    public function showRegister()
    {
        return view('pages.guest.auth.register-guest');
    }

    public function Register(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'email'      => 'required|email|unique:guests',
            'password'   => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'name'       => 'required',
            'status'     => 'required',
            'pekerjaan'  => 'required',
            'mobile_no'  => 'required|min:10|max:14',
            'berkas'     => 'required|mimes:pdf|max:2048'
        ]);

        try {
            $berkas= $request->file('berkas');
            $nama= str_replace(' ','_',$request->input('name'));
            $email= md5($request->input('email'));
            $extension= $berkas->getClientOriginalExtension();
            $filename= $nama.'_'.$email.'.'.$extension;
            $tujuan_upload = 'data_files/bukti_guests';
            $berkas->move($tujuan_upload,$filename);


            Guest::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'pekerjaan' => $request->input('pekerjaan'),
                'mobile_no' => $request->input('mobile_no'),
                'status_gs' => 0,
                'berkas_verifikasi' => $filename,
            ]);

            Session::flash('success', 'Akun berhasil didaftarkan, silahkan menunggu akun untuk diverifikasi');
            // return view('pages.guest.auth.login-guest');
            return view('pages.guest.login-warning');
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
}
