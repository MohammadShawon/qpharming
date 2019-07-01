<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Company List */
        if (auth()->user()->can('view_company')) {
                
            $data['companies'] = Company::latest()->get(['id','name','phone1','representative_name','status','created_at']);
            return view('admin.company.index', $data);
            
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
        /* Company Create Form */
        if (auth()->user()->can('create_company')) {
            return view('admin.company.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        /* Create Compnay */
        if (auth()->user()->can('create_company')) {
                
            $company = Company::create([
            'name'                  => $request->company,
            'slug'                  => str_slug($request->company),
            'representative_name'   => $request->representative_name,
            'phone1'                => $request->phone1,
            'phone2'                => $request->phone2,
            'email'                 => ($request->email != null ? $request->email : null),
            'address'               => ($request->address != null ? $request->address : null),
            'opening_balance'       => ($request->opening_balance != null?$request->opening_balance:0),
            'starting_date'         => Carbon::parse($request->starting_date)->format('Y-m-d H:i'),
            'ending_date'           => Carbon::parse($request->ending_date)->format('Y-m-d H:i')
            ]);

            /* cheack and showing toastr message */
            if($company){
                Toastr::success('Company Successfully Added', 'Success');
                return redirect()->route('admin.company.index');
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
        /* Company Details */
        $company = Company::findOrFail($id);
        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('edit_company')) {
                
            $company = Company::findOrFail($id);
            return view('admin.company.edit', compact('company'));
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
    public function update(CompanyUpdateRequest $request, $id)
    {
        /* Update Company */
        if (auth()->user()->can('edit_company')) {
                
            $company = Company::findOrFail($id);
            $Resultcompany = $company->update([
                'name'                  => $request->company,
                'slug'                  => str_slug($request->company),
                'representative_name'   => $request->representative_name,
                'phone1'                => $request->phone1,
                'phone2'                => $request->phone2,
                'email'                 => $request->email,
                'address'               => $request->address,
                'opening_balance'       => $request->opening_balance,
                'status'                => $request->status,
                'starting_date'         => Carbon::parse($request->starting_date)->format('Y-m-d H:i'),
                'ending_date'           => Carbon::parse($request->ending_date)->format('Y-m-d H:i')
            ]);
            /* cheack and showing toastr message */
            if($Resultcompany){
                Toastr::success('Company Successfully Update', 'Success');
                return redirect()->route('admin.company.index');
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
        /* Delete Company */
        if (auth()->user()->can('delete_company')) {
                
            $companyDelete = Company::findOrFail($id)->delete();
            if($companyDelete){
                Toastr::success('Company Successfully Deleted', 'Success');
                return redirect()->route('admin.company.index');
            }
            abort(404);
        }
        abort(403);
    }
}
