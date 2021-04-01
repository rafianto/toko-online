<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * For Index Page Dashboard
     * 
     */
    public function index()
    {
        return view('admins.dashboard.index');
    }
}
