<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Session;

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

    public function getUserList() {

        $students = Student::paginate(20);

        return view ('dashboard.pages.admins.userlist')->with('students', $students);
    }

}
