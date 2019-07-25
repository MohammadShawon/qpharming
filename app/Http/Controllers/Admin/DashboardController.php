<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class   DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index(){
        $branches = Branch::latest()->get();
        $users = User::latest()->get();
        $audits = Audit::latest()->paginate(8);;
        /*
         * Check Roles
         * @return Related Views
         * */
        if (auth()->user()->hasRole('admin'))
        {
            return view('admin.dashboard.admin', compact('branches','users', 'audits'));
        }elseif (auth()->user()->hasRole('manager'))
        {
            return view('admin.dashboard.manager', compact('branches','users', 'audits'));
        }
        else{
            return view('admin.dashboard.admin', compact('branches','users', 'audits'));
        }

    }
}
