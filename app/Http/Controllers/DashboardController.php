<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getHome() {

        return view('dashboard.pages.home');
    }
}
