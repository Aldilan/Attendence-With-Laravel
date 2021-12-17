<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() 
    {
        return view('dashboard_admin.index');
    }
}
