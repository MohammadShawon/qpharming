<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchInfoController extends Controller
{
    public function index() {
        $branches = Branch::with('users')->latest()->get();
        
        return view('admin.branchinfo.index', compact('branches'));
    }
}
