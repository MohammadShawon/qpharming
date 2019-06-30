<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmerRecordDashboardController extends Controller
{
    public function index()
    {
    	return view('admin.farmerrecord.dashboard');
    }
}
