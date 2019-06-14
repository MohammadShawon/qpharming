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
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $roles = Role::latest()->get();
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
        if(Auth::user()->hasRole('superadmin')){
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
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            return view('superadmin.role.edit', compact('role', 'permissions'));
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
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
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
        if(Auth::user()->hasRole('superadmin')){
             Role::findOrFail($id)->delete();
            Toastr::success('Role Successfully Deleted', 'Success');
            return redirect()->route('super-admin.role.index');
        }
        abort(403);
       
    }
}
