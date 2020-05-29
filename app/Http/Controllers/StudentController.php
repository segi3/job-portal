<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use App\Student;


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
            if (Hash::check($request->input('password'), $student->password)) {
                $request->session()->put([
                    'login' => true,
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'role' => 'student',
                ]);
                Session::flash('success', 'Anda berhasil Login');
                return redirect('/');
            }else{
                Session::flash('error', 'Password tidak cocok');
                return redirect()->route('student.showLogin');
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

        $this->validate($request, [
            'email'         => 'required|email|unique:students',
            'password'      => 'required|min:8',
            'name'          => 'required',
            'nrp'           => 'required|min:14|max:14|unique:students',
            'gender'        => 'required',
            'birthday'      => 'required',
            'mobile_no'     => 'required|min:12|max:14',
            'address'       => 'required|max:255',
            'city'          => 'required|max:255',
            'province'      => 'required|max:255',
            'hobby'         => 'required|max:255',
            'skill'         => 'required|max:255',
            'achievment'    => 'required|max:255',
            'experience'    => 'required|max:255',
        ]);

        // dd($request);

        try {
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
            ]);

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
