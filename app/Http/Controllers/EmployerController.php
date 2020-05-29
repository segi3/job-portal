<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Employer;

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
        if($employer) {
            if(Hash::check($request->input('password'), $employer->password)) {

                $request->session()->put([
                    'login'     => true,
                    'id'        => $employer->id,
                    'name'      => $employer->name,
                    'email'     => $admin->email,
                    'role'      => 'employer',
                ]);

                Session::flash('success', 'Anda berhasil Login');
                return redirect('/');
            }else{
                // password salah
                return redirect()->route('employer.showLogin');
            }
        }
        else
        {
            return redirect()->route('employer.showRegister');
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
        // dd($input);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employers',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'website' => 'required',
            'contact_person' => 'required',
            'contact_no' => 'required|max:13',
            'fax' => 'nullable',
            'password' => 'required|min:8',
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
                'status' => 0,
                'password' => Hash::make($request->input('password')),
            ]);

            Session::flash('success', 'User berhasil didaftarkan');
            return redirect('/login-er');
            // return redirect()->route('employer.showLogin');

        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect('/register-er');
            }
        }
    }
}
