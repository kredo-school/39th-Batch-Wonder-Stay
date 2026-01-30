<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // dammy data
        $recentReservations = collect();
        $upcomingCheckIns   = collect();

        return view('admin.dashboard', compact('recentReservations', 'upcomingCheckIns'));
    }
}
