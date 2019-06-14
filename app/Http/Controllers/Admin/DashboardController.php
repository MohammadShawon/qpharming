<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index(){
        $branches = Branch::latest()->get();
        $users = User::latest()->get();
        return view('admin.dashboard', compact('branches','users'));
    }
}
