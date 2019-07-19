<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;

class   DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index(){
        $branches = Branch::latest()->get();
        $users = User::latest()->get();
        /*
         * Check Roles
         * @return Related Views
         * */
        if (auth()->user()->hasRole('admin'))
        {
            return view('admin.dashboard.admin', compact('branches','users'));
        }elseif (auth()->user()->hasRole('manager'))
        {
            return view('admin.dashboard.manager', compact('branches','users'));
        }
        else{
            return view('admin.dashboard.admin', compact('branches','users'));
        }

    }
}
