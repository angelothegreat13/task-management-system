<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    // display dashboard with list of tasks
    public function index()
    {
        return view ('layouts.master');
        // return view('dashboard');
    }

}
