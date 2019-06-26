<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\PurposeHead;
use App\Models\Farmer;
use App\Models\Company;
use App\Http\Requests\Payment\PaymentStoreRequest;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Branch;
use App\Http\Requests\Payment\PayentUpdateRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['banks']          = Bank::get(['id','bank_name']);
        $data['purposeheads']   = PurposeHead::get(['id','name']);
        $data['farmers']        = Farmer::get(['id','name']);
        $data['companies']      = Company::get(['id','name']);
        
        return view('admin.payment.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentStoreRequest $request)
    {
        /* Insert Payment */
        $payment = Payment::create([
            'bank_id'        =>      $request->bank_id,
            'purposehead_id' =>      $request->purposehead_id,
            'company_id'     =>      $request->company_id,
            'farmer_id'      =>      $request->farmer_id,
            'payment_amount' =>      $request->payment_amount,
            'payment_type'   =>      $request->payment_type,
            'bank_name'      =>      $request->bank_name,
            'received_by'    =>      $request->received_by,
            'remarks'        =>      $request->remarks,
            'payment_date'   =>      Carbon::parse($request->payment_date)->format('Y-m-d H:i'),
        ]);


        /* Check Payment insertion  and Toastr */
        if($payment){
            Toastr::success('Payment Inserted Successfully', 'Success');
            return redirect()->route('admin.payment.index');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        /* Details of a Single Payment */
        return view('admin.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        /* Payment Edit form */
        $data['banks']          = Bank::get(['id','bank_name']);
        $data['purposeheads']   = PurposeHead::get(['id','name']);
        $data['farmers']        = Farmer::get(['id','name']);
        $data['companies']      = Company::get(['id','name']);
        
        return view('admin.payment.edit', $data, compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PayentUpdateRequest $request, Payment $payment)
    {
        /* Update Payment */
        $paymentUpdate = $payment->update([
            'bank_id'        =>      $request->bank_id,
            'purposehead_id' =>      $request->purposehead_id,
            'company_id'     =>      $request->company_id,
            'farmer_id'      =>      $request->farmer_id,
            'payment_amount' =>      $request->payment_amount,
            'payment_type'   =>      $request->payment_type,
            'bank_name'      =>      $request->bank_name,
            'received_by'    =>      $request->received_by,
            'remarks'        =>      $request->remarks,
            'payment_date'   =>      Carbon::parse($request->payment_date)->format('Y-m-d H:i'),
        ]);


        /* Check Payment insertion  and Toastr */
        if($paymentUpdate){
            Toastr::success('Payment Updated Successfully', 'Success');
            return redirect()->route('admin.payment.index');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        /* Payment Delete */
        $paymentDelete = $payment->delete();
        if($paymentDelete){
            Toastr::success('Payment Deleted Successfully', 'Success');
            return redirect()->route('admin.payment.index');
        }
    }
}
