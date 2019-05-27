<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Http\Requests\Branch\BranchStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Branch\BranchUpdateRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('view_branch')) {
                
                $branches = Branch::latest()->get();
                return view('admin.branch.index', compact('branches'));
            }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create_branch')) {
                
                $areas = Area::all();
                return view('admin.branch.create', compact('areas'));
            }
        abort(403); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchStoreRequest $request)
    {
        if (auth()->user()->can('create_branch')) {
                        /* create branch */
                $branch = Branch::create([
                    'name' => $request->branch,
                    'slug' => str_slug($request->branch),
                    'area_id' => $request->area,
                ]);
                /* cheack and showing toastr message */
                if($branch){
                    Toastr::success('Branch Successfully Added', 'Success');
                    return redirect()->route('admin.branch.index');
                }
                abort(404);
                
            }
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
       if (auth()->user()->can('edit_branch')) {
               
                $areas = Area::all();
                return view('admin.branch.edit', compact('branch', 'areas'));
           }
       abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchUpdateRequest $request, Branch $branch)
    {
         if (auth()->user()->can('edit_branch')) {
                 
                         /* update branch */
                 $resultBranch = $branch->update([
                    
                    'area_id'  =>   $request->area,
                    'name'     =>   $request->branch,
                    'slug'     =>   str_slug($request->branch),
                ]);

                /* cheack and showing toastr message */
                if($resultBranch){
                    Toastr::success('Branch Successfully Updated', 'Success');
                    return redirect()->route('admin.branch.index');
                }
                abort(404);
             }
         abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        if (auth()->user()->can('delete_branch')) {
                
                $branch->delete();
                Toastr::success('Branch Successfully Deleted', 'Success');
                return redirect()->route('admin.branch.index');
            }
        abort(403);
    }
}
