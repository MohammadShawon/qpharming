<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Role\RoleStoreRequest;
use App\Http\Requests\SuperAdmin\Role\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* ROLE list */
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $roles = Role::with('permissions')->latest()->get();
            return view('superadmin.role.index', compact('roles'));
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
        /* Role CREATE form */
        if(Auth::user()->hasRole('superadmin')){
            return view('superadmin.role.create');
        }
        abort(403);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        /*  store role */
        if(Auth::user()->hasRole('superadmin')){
            
            $role = Role::create([
                'name'  => strtolower($request->role)
            ]);

            /* Cheack role and toast message */
            if($role)
            {
                Toastr::success('Role Successfully Inserted', 'Success');
                return redirect()->route('super-admin.role.index');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* Role EDIT form */
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $role = Role::findOrFail($id);
            $data['permissions'] = Permission::get(['id','name']);
            return view('superadmin.role.edit', $data, compact('role'));
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
    public function update(RoleUpdateRequest $request, $id)
    {
        /*  Role  UPDATE*/
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            
            $role = Role::findOrFail($id);
            $resultRole = $role->update([
                'name' => strtolower($request->role)
            ]);
            
            /* Update assigining roles permissions */
            $role->permissions()->sync($request->permissions);

            /* check Role and toast message */
            if($resultRole){
                Toastr::success('Role Successfully Updated', 'Success');
                return redirect()->route('super-admin.role.index');
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
        /* Role DELETE */
        if(Auth::user()->hasRole('superadmin')){
            $roleDelete = Role::findOrFail($id)->delete();
            if($roleDelete){
                Toastr::success('Role Successfully Deleted', 'Success');
                return redirect()->route('super-admin.role.index');
            }
            abort(404);
        }
        abort(403);
       
    }
}
