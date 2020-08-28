<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use App\Mentor;

class MentorController extends Controller
{
    public function viewLogin() {

        return view('dashboard.pages.mentor.auth.mentor-login');

    }

    public function viewRegister() {

        return view('dashboard.pages.mentor.auth.mentor-register');

    }

    public function Register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'nip'           => 'required|digits:14|unique:mentors',
            'email'         => 'required|email|unique:mentors',
            'mobile_no'     => 'required|digits_between:10,14',
            'password'      => 'required|min:8',
            'password_confirmation'=>'required|min:8|same:password',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            Session::flash('error', $validator->errors());
            return redirect()->back()->withInput();
        }

        try {
            Mentor::create([
                'name' => $request->input('name'),
                'nip'  => $request->input('nip'),
                'email' => $request->input('email'),
                'mobile_no' => $request->input('mobile_no'),
                // 'password' => Hash::make($request->input('password')),
                'password' => $request->input('password'),
            ]);
            // dd('try');
            Session::flash('success', 'Mentor berhasil didaftarkan');
            return redirect(route('mentor.viewLogin'));

        }catch(\Illuminate\Database\QueryException $e){
            dd('catch');
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('mentor.viewLogin'));
            }
        }
    }

    public function Login(Request $request) {

        $cek = Mentor::where('email', '=', $request->input('email'))->first();
        if($cek) {

            if($request->input('password') == $cek->password) {

                $request->session()->put([
                    'login'     => true,
                    'name'      => $cek->name,
                    'id'        => $cek->id,
                    'email'     => $cek->email,
                    'nip'       => $cek->nip,
                    'role'      => 'mentor',
                    'mobile_no' => $cek->mobile_no,
                ]);

                Session::flash('success', ['Succes']);
                return redirect('/dashboard');
            }else{
                Session::flash('error', ['Invalid password']);
                return redirect()->back()->withInput();
            }
        }else{
            Session::flash('error', ['Account not Found']);
            return redirect()->back()->withInput();

        }

    }


}
