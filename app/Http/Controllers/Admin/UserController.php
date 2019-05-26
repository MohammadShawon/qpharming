<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\Role;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('admin.user.create', compact('branches', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        /* Insert User */
        $user = User::create([
            'branch_id'        =>      $request->branch,
            'name'             =>      $request->user,
            'username'         =>      $request->username,
            'phone1'           =>      $request->phone1,
            'phone2'           =>      $request->phone2,
            'email'            =>      $request->email,
            'password'         =>      bcrypt($request->password),
            'address'          =>      $request->address,
            'status'           =>      'active',
        ]);

        /* assigning roles to the user */
        if($user){
            $user->roles()->attach($request->roles);
        }

        /* Check famer insertion  and Toastr */
        if($user){
            Toastr::success('User Inserted Successfully', 'Success');
            return redirect()->route('admin.user.index');
        }
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
        $roles = Role::all();
        $branches = Branch::all();
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user','branches', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        /* update user with password */
        if(!empty($request->password)){
            $user->update([
                'branch_id'        =>      $request->branch,
                'name'             =>      $request->user,
                'username'         =>      $request->username,
                'phone1'           =>      $request->phone1,
                'phone2'           =>      $request->phone2,
                'email'            =>      $request->email,
                'password'         =>      bcrypt($request->password),
                'address'          =>      $request->address,
                'status'           =>      $request->status,
            ]);
        } 
        /* update user without password */
        else{
            $user->update([
                'branch_id'        =>      $request->branch,
                'name'             =>      $request->user,
                'username'         =>      $request->username,
                'phone1'           =>      $request->phone1,
                'phone2'           =>      $request->phone2,
                'email'            =>      $request->email,
                'address'          =>      $request->address,
                'status'           =>      $request->status,
            ]);
        }

        /* update roles to the user */
        if($user){
            $user->roles()->sync($request->roles);
        }

        /* Check famer insertion  and Toastr */
        if($user){
            Toastr::success('User Updated Successfully', 'Success');
            return redirect()->route('admin.user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDelete = User::findOrFail($id)->delete();
        
        if($userDelete){
            Toastr::success('User Deleted Successfully', 'Success');
            return redirect()->route('admin.user.index');
        }
    }
}
