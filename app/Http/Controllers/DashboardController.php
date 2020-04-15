<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getHome(Request $request) {

        if ($request->session()->get('role') == 'admin') {

            return view('dashboard.pages.admins.home');

        } elseif ($request->session()->get('role') == 'employer') {
            
            return view('dashboard.pages.employers.home');

        }

        return view('/');
        
    }
}
