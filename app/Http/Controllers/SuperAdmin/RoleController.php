<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\SuperAdmin\Role\RoleStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\SuperAdmin\Role\RoleUpdateRequest;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('superadmin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        //  store role
        $role = Role::create([
            'name'  => strtolower($request->role)
        ]);

        
        // check rolee and toast message
        if($role)
        {
            Toastr::success('Role Successfully Inserted', 'Success');
            return redirect()->route('super-admin.role.index');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('superadmin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        /* update Role */
        $role = Role::findOrFail($id);
        $resultRole = $role->update([
            'name' => strtolower($request->role)
        ]);
        /* 
            Update assigining roles permissions
        */
        $role->permissions()->sync($request->permissions);

        //check Role and toast message
        
        if($resultRole){
            Toastr::success('Role Successfully Updated', 'Success');
            return redirect()->route('super-admin.role.index');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        Toastr::success('Role Successfully Deleted', 'Success');
        return redirect()->route('super-admin.role.index');
    }
}
