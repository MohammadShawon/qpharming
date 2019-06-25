<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bank\BankStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Bank\BankUpdateRequest;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* All bank list in index page */
        $banks = Bank::latest()->get();
        return view('admin.bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* bank create page */
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankStoreRequest $request)
    {
        /*  store bank */
        $bank = Bank::create([
            'bank_name'        => $request->bank_name,
            'account_name'     => $request->account_name,
            'account_number'   => $request->account_number,
            'opening_balance'  => $request->opening_balance,
            
        ]);
        /*  check bank and toast message */
        if($bank)
        {
            Toastr::success('Bank Successfully Inserted', 'Success');
            return redirect()->route('admin.bank.index');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('admin.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(BankUpdateRequest $request, Bank $bank)
    {
        /* update Bank */
        
        $bank = $bank->update([
            'bank_name'        => $request->bank_name,
            'account_name'     => $request->account_name,
            'account_number'   => $request->account_number,
            'opening_balance'  => $request->opening_balance,
        ]);

        /* check Bank and toast message */
        if($bank){
            Toastr::success('Bank Successfully Updated', 'Success');
            return redirect()->route('admin.bank.index');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        /* delete bank */
        $bankDelete = $bank->delete();
        if($bankDelete){
            Toastr::success('Bank Successfully Deleted', 'Success');
            return redirect()->route('admin.bank.index');
        }
    }
}
