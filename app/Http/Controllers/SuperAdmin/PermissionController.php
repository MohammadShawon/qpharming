<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Permission\PermissionStoreRequest;
use App\Http\Requests\SuperAdmin\Permission\PermissionUpdateRequest;
use App\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('superadmin')) {
            $permissions = Permission::latest()->get();
            return view('superadmin.permission.index', compact('permissions'));
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
        if (Auth::user()->hasRole('superadmin')) {
            return view('superadmin.permission.create');
        }
        abort(403);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        if (Auth::user()->hasRole('superadmin')) {
            //  store Permission name
            $permission = Permission::create([
                'name'  => $request->permission
            ]);

            
            // check Permission and toast message
            if($permission)
            {
                Toastr::success('Permission Successfully Inserted', 'Success');
                return redirect()->route('super-admin.permission.index');
            }
            abort(404);
        }
        abort(403);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole('superadmin')) {
            $permission = Permission::findOrFail($id);
            return view('superadmin.permission.edit', compact('permission'));
        }
        abort(403);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        if (Auth::user()->hasRole('superadmin')) {
            /* update Permission name */
            $permission = Permission::findOrFail($id);
            $resultPermission = $permission->update([
                'name' => $request->permission
            ]);

            //check Permission and toast message
            if($resultPermission){
                Toastr::success('Permission Successfully Updated', 'Success');
                return redirect()->route('super-admin.permission.index');
            }
            abort(404);
        }
        abort(403);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('superadmin')) {
            Permission::findOrFail($id)->delete();
            Toastr::success('Permission Successfully Deleted', 'Success');
            return redirect()->route('super-admin.permission.index');
        }
        abort(403);
        
    }
}
