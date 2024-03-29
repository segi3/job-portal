<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Employer;
use Image;
use Validator;
use Illuminate\Support\Facades\DB;

class EmployerController extends Controller
{
    public function showLogin() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        return view('pages.employer.auth.login-employer');

    }

    // login
    public function Login(Request $request) {


        $employer = Employer::where('email', '=', $request->input('email'))->first();

        // if($employer){
        //     if($employer->status == 0){
        //         Session::flash('error', 'status : tidak aktif');
        //     }else if ($employer->status == 1){
        //         Session::flash('error', 'status : aktif');
        //     }else if ($employer->status == 2){
        //         Session::flash('error', 'status : ditolak');
        //     }
        //     return redirect()->route('employer.showLogin');
        // }



        if($employer) {
            if($employer->status == 1){
                if(Hash::check($request->input('password'), $employer->password)) {

                    $request->session()->put([
                        'login'     => true,
                        'id'        => $employer->id,
                        'name'      => $employer->name,
                        'email'     => $employer->email,
                        'role'      => 'employer',
                    ]);

                    Session::flash('success', 'Anda berhasil Login');
                    return redirect('/dashboard');
                }else{
                    // password salah
                    Session::flash('error', 'Password tidak cocok');
                    return redirect()->route('employer.showLogin');
                }
            }else if($employer->status == 0){
                return view('pages.employer.login-warning');
            }else if($employer->status == 2){
                return view('pages.employer.login-reject');
            }

        }else {
            Session::flash('error', 'Akun tidak ditemukan');
            return redirect()->route('employer.showLogin');
        }

    }

    public function showRegister() {
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

        return view('pages.employer.auth.register-employer');
    }

    public function Register(Request $request)
    {
        // dd($request);
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'berkas_verifikasi'  => 'required|mimes:pdf|max:2048',
            'email' => 'required|email|unique:employers',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'website' => 'nullable',
            'contact_person' => 'required',
            'contact_no' => 'required|max:14',
            'fax' => 'nullable',
            'password' => 'required|min:8|required_with:password_confirmation',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        // $this->validate($request, [
        //     'name' => 'required',
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'email' => 'required|email|unique:employers',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'province' => 'required',
        //     'website' => 'nullable',
        //     'contact_person' => 'required',
        //     'contact_no' => 'required|max:14',
        //     'fax' => 'nullable',
        //     'password' => 'required|min:8|required_with:password_confirmation',
        //     'password_confirmation' => 'required|min:8|same:password',
        // ]);

        try {
            $filelogo = $request->file('logo');
            $email= $request->input('email');
            $extension= $filelogo->getClientOriginalExtension();
            $namafile=md5($email);
            $hashname= $namafile.'.'.$extension;
            $tujuan_upload = 'data_files/Employer/employer_logo';
            $filelogo->move($tujuan_upload,$hashname);

            $berkas= $request->file('berkas_verifikasi');
            $nama= str_replace(' ','_',$request->input('name'));
            $email= md5($request->input('email'));
            $extension= $berkas->getClientOriginalExtension();
            $filename= $nama.'_'.$email.'.'.$extension;
            $tujuan = 'data_files/Employer/berkas_verifikasi';
            $berkas->move($tujuan,$filename);

            

            // $filecrop= Image::make($filelogo->path());
            // $filecrop->crop(400,400)->save($tujuan_upload.'/'.$hashname);
            // // $filelogo->move($tujuan_upload,$hashname);
            // echo $hashname;
            Employer::create([
                'name' => $request->input('name'),
                'logo' => $hashname,
                'berkas_verifikasi' => $filename,
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'website' => $request->input('website'),
                'contact_no' => $request->input('contact_no'),
                'contact_person' => $request->input('contact_person'),
                'fax' => $request->input('fax'),
                'status' => 0,
                'password' => Hash::make($request->input('password')),
            ]);


            Session::flash('success', 'Akun berhasil didaftarkan, silahkan menunggu akun untuk diverifikasi');
            return view('pages.employer.login-warning');
            // return redirect()->route('employer.showLogin');

        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/register-er');
            }
            Session::flash('error', $errorMsg);
            return redirect()->back();
        }
    }
    public function downloadberkas($berkas)
    {
        $where = [
            'employers.id' => $berkas,
        ];

        $berkas_db = DB::table('employers')
        ->select('employers.name as name', 'employers.email as email', 'employers.berkas_verifikasi as berkas')
        ->where($where)
        ->first();

        $file = public_path('data_files/Employer/berkas_verifikasi/'.$berkas_db->berkas);
        return response()->download($file, $berkas_db->berkas);
    }
}
