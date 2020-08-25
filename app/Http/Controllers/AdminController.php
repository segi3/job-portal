<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Admin;

class AdminController extends Controller
{
    // menampilkan form login admin
    public function showLogin() {

        return view('dashboard.pages.admins.auth.supersecretlogin');
        
    }

    // login admin
    public function Login(Request $request) {

        $admin = Admin::where('email', '=', $request->input('email'))->first();
        if($admin) {
            if(Hash::check($request->input('password'), $admin->password)) {

                $request->session()->put([
                    'login'     => true,
                    'name'      => $admin->name,
                    'id'        => $admin->id,
                    'email'     => $admin->email,
                    'role'      => 'admin',
                    'mobile_no' => $admin->mobile_no,
                ]);

                Session::flash('success', 'Anda berhasil Login');
                return redirect('/dashboard');
            }else{
                // password salah
                return redirect('/adminsuperscretloginY');
            }
        }else{
            // admin tidak ditemukan
        }

    }

    // menampilkan form register admin
    public function showRegister() {

        return view('dashboard.pages.admins.auth.supersecretregister');
        
    }

    // mendaftarkan admin
    public function Register(Request $request) {

        try {
            Admin::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile_no' => $request->input('mobile_no'),
                'password' => Hash::make($request->input('password')),
            ]);

            Session::flash('success', 'User berhasil didaftarkan');
            return redirect('/adminsuperscretloginY');

        }catch(\Illuminate\Database\QueryException $e){

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/admin/login');
            }
        }
    }
}
