<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Customer\CustomersDataTable;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateReuest;
use App\Models\Branch;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CustomersDataTable $dataTable
     * @return void
     */
    public function index(CustomersDataTable $dataTable)
    {
        if (auth()->user()->can('view_customer'))
        {
            return $dataTable->render('admin.customer.index');
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
        if (auth()->user()->can('create_customer'))
        {
            return view('admin.customer.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        if (auth()->user()->can('create_customer'))
        {
            $customer = Customer::create([
               'name'           => $request->name,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'created_at'    => Carbon::now('+6.30'),
                'updated_at'    => Carbon::now('+6.30'),
            ]);
            if ($customer)
            {
                Toastr::success('Customer Added Successfully','success');
                return redirect()->route('admin.customer.index');
            }
            abort(404);
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
        if (auth()->user()->can('view_customer'))
        {
            return redirect()->route('admin.customer.index');
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return void
     */
    public function edit(Customer $customer)
    {
        if (auth()->user()->can('edit_customer')) {

            return view('admin.customer.edit', $customer, compact('customer'));
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
    public function update(CustomerUpdateReuest $request, Customer $customer)
    {
        if (auth()->user()->can('edit_customer'))
        {
            $updateCustomer = $customer->update([
               'name'       => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'updated_at' => Carbon::now('+6.30'),
            ]);
            if ($updateCustomer)
            {
                Toastr::success('Customer Updated Success','success');
                return redirect()->route('admin.customer.index');
            }else{
                Toastr::success('Customer Updated Failed','error');
                return redirect()->route('admin.customer.index');
            }
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
        //
    }
}
