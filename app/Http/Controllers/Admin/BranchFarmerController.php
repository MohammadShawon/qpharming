<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Farmers\BranchFarmersDatatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchFarmerController extends Controller
{
    public function farmerList(BranchFarmersDatatables $dataTable,$branch_id) {
        $data['branch'] = Branch::find($branch_id);
        return $dataTable->with(['branch_id' => $branch_id])->render('admin.branchfarmelist.farmerlist',$data);

    }
}
