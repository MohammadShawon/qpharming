<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchFarmerController extends Controller
{
    public function farmerList($branch_id) {
        
        // $branchesFarmers = Branch::findOrFail($branch_id)->farmers;
        // return $branchesFarmers;
        return view('admin.branchfarmelist.farmerlist');

    }
}
