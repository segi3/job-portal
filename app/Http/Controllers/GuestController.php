<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;
use App\Guest;

class GuestController extends Controller
{
    public function showLogin()
    {
        return view('pages.guest.auth.login-guest');
    }

    public function Login(Request $request)
    {
        $guest = Guest::where('email', '=', $request->input('email'))->first();

        if ($guest) {
            if (Hash::check($request->input('password'), $guest->password)) {
                $request->session()->put([
                    'login' => true,
                    'id' => $guest->id,
                    'name' => $guest->name,
                    'email' => $guest->email,
                    'role' => 'guest',
                ]);

                Session::flash('success', 'Anda berhasil login');
                return redirect('/');
            }else{
                Session::flash('error', 'Password tidak cocok');
                return redirect()->route('guest.showLogin');
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
            'name'       => 'required',
            'status'     => 'required',
            'pekerjaan'  => 'required',
            'mobile_np'  => 'mobile_no|min:12|max:14',
        ]);

        try {
            Guest::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'pekerjaan' => $request->input('pekerjaan'),
                'mobile_no' => $request->input('mobile_no'),
            ]);

            Session::flash('success', 'Akun berhasil didaftarkan');
            return view('pages.guest.auth.login-guest');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/');
            }
            Session::flash('error', $errorCode);
            return view('pages.guest.auth.register-guest');
        }
    }
}
