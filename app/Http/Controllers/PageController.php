<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getHome() {

        return view('pages.home');
    }

    public function showWelcomeLogin() {

        return view('pages.login-welcome');
    }
}
