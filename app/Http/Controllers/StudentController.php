<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function showLogin()
    {
        return view('pages.student.auth.login-student');
    }

    public function showRegister()
    {
        return view('pages.student.auth.register-student');
    }

    public function Login(Request $request)
    {
        $student = Student::where('email' ,'=', $request->input('email'))->first();

        if ($student) {
            if($student->status == 1){
                if (Hash::check($request->input('password'), $student->password)) {

                    $isInvestee = DB::table('investee')->where('student_id', '=', $student->id)
                                                    ->Where('status', '=', '1')
                                                    ->first();

                    
                    $IYT = DB::table('investasi_iyt')
                                ->leftjoin('i_y_t_batches', 'i_y_t_batches.id', 'investasi_iyt.batch_id')
                                ->where('i_y_t_batches.status', '=', '1')
                                ->where('investasi_iyt.student_id', '=', $student->id)
                                ->select('*', 'investasi_iyt.status as status_iyt', 'investasi_iyt.kategori as tingkat_iyt')
                                ->first();
                    $now = Carbon::now();
                    $dn = $now->toDateString();

                    if ($isInvestee)
                        $isInvestee = true;
                    else
                        $isInvestee = false;

                    if ($IYT){

                        $invoice= $IYT->invoice_iyt;
                        $tingkat_iyt = $IYT->tingkat_iyt;

                        if($IYT->status_iyt == 1){
                            $isIYT = true;
                        }else{
                            $isIYT = false;
                        }
                    }
                    else{
                        $invoice = 0;
                        $tingkat_iyt = 0;
                        $isIYT = false;
                    }

                    // dd($isActive);

                    $request->session()->put([
                        'login' => true,
                        'id' => $student->id,
                        'name' => $student->name,
                        'email' => $student->email,
                        'role' => 'student',
                        'investee' => $isInvestee,

                        'invoice' => $invoice,
                        'iyt' => $isIYT,
                        'tingkat_iyt' => $tingkat_iyt,

                        // 'batch' => $isActive,
                    ]);
                    Session::flash('success', 'Anda berhasil Login');
                    return redirect('/dashboard');
                }else{
                    Session::flash('error', 'Password tidak cocok');
                    return redirect()->route('student.showLogin');
                }
            }else if($student->status == 0){
                return view('pages.employer.login-warning');
            }else if($student->status == 2){
                return view('pages.employer.login-reject');
            }
        }else{
            Session::flash('error', 'Akun tidak ditemukan');
            return redirect()->route('student.showLogin');
        }
        return view('pages.student.auth.register-student');
    }

    public function Register(Request $request)
    {
        // dd($request);

        $formatDate = \Carbon\Carbon::parse($request->input('birthday'))->format('Y-m-d');
        // var_dump($request->input('birthday'));
        // dd($formatDate);

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:students',
            'password'      => 'required|min:8',
            'password_confirmation'=>'required|min:8|same:password',
            'name'          => 'required',
            'nrp'           => 'required|min:14|max:14|unique:students',
            'gender'        => 'required',
            'birthday'      => 'required',
            'mobile_no'     => 'required|min:10|max:14',
            'address'       => 'required|max:255',
            'city'          => 'required|max:255',
            'province'      => 'required|max:255',
            'hobby'         => 'required|max:255',
            'skill'         => 'required|max:255',
            'achievment'    => 'required|max:255',
            'experience'    => 'required|max:255',
            'berkas_verifikasi' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }

        // dd($request);

        try {
            $berkas = $request->file('berkas_verifikasi');
            $nama = str_replace(' ','_',$request->input('name'));
            $email = md5($request->input('email'));
            $ext = $berkas->getClientOriginalExtension();
            $filename = $nama.'_'.$email.'.'.$ext;
            $tujuan = 'data_files/Student/berkas_validasi';


            Student::create([
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('password')),
                'name'          => $request->input('name'),
                'nrp'           => $request->input('nrp'),
                'gender'        => $request->input('gender'),
                'birthdate'     => $formatDate,
                'mobile_no'     => $request->input('mobile_no'),
                'address'       => $request->input('address'),
                'city'          => $request->input('city'),
                'province'      => $request->input('province'),
                'hobby'         => $request->input('hobby'),
                'skill'         => $request->input('skill'),
                'achievment'    => $request->input('achievment'),
                'experience'    => $request->input('experience'),
                'berkas_validasi' => $filename,
            ]);

            $berkas->move($tujuan, $filename);

            Session::flash('success', 'Akun berhasil didaftarkan');
            return view('pages.student.auth.login-student');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return view('pages.student.auth.register-student');
        }
    }
}
