<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Employer;

class EmployerController extends Controller
{
    public function showLogin() {

        return view('dashboard.pages.admins.auth.login');
        
    }

    // login 
    public function Login(Request $request) {

        $employer = Employer::where('email', '=', $request->input('email'))->first();
        if($employer) {
            if(Hash::check($request->input('password'), $employer->password)) {

                // $request->session()->put([
                //     'login'     => true,
                //     'name'      => $admin->name,
                //     'email'     => $admin->email,
                //     'role'      => 'admin',
                //     'mobile_no' => $admin->mobile_no,
                // ]);

                Session::flash('success', 'Anda berhasil Login');
                return redirect('/');
            }else{
                // password salah
                return redirect('/login');
            }
        }
        else
        {
            return redirect('/register');
        }

    }

    public function showRegister() {

        return view('dashboard.pages.admins.auth.register');
        
    }

    public function Register(Request $request) 
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employers',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'website' => 'required',
            'contact_person' => 'required|max:13',
            'contact_no' => 'required|max:13',
            'fax' => 'nullable',
            'password' => 'required|min:6',
        ]);
        try {
            Employer::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'website' => $request->input('website'),
                'contact_no' => $request->input('contact_no'),
                'contact_person' => $request->input('contact_person'),
                'fax' => $request->input('fax'),
                'password' => Hash::make($request->input('password')),
            ]);

            Session::flash('success', 'User berhasil didaftarkan');
            return redirect('/login');

        }catch(\Illuminate\Database\QueryException $e){

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/register');
            }
        }
    }
}
