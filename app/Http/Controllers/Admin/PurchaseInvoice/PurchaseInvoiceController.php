<?php

namespace App\Http\Controllers\Admin\PurchaseInvoice;

use App\Models\Company,App\Models\Purchase;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * First Check the user Permission
         * @return create form
         * */
        if (auth()->user()->can('view_purchase'))
        {
            return view('admin.purchaseinvocie.index');
        }
        /*
         * If Not Permission Assigned
         * */
        Toastr::error('You Do Not Have Permission!','error');
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * First Check the user Permission
         * @return create form
         * */
        if (auth()->user()->can('create_purchase'))
        {
            $data['companies'] = Company::where('status','active')->pluck('id','name');
            $data['purchase'] = Purchase::orderBy('id','DESC')->first();
            return view('admin.purchaseinvocie.create',$data);
        }
        /*
         * If Not Permission Assigned
         * */
        Toastr::error('You Do Not Have Permission!','error');
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
