<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\User;
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
        /* Payment List */
        $data['payments'] = Payment::where('status','active')->latest()->get(['id','company_id','farmer_id','payment_amount','payment_type','received_by','payment_date','user_id','payee_type']);
        $data['pending'] = Payment::where('status','pending')->latest()->get(['id','company_id','farmer_id','payment_amount','payment_type','received_by','payment_date','user_id','payee_type']);

        return view('admin.payment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* Payment CREATE form */
        $data['banks']          = Bank::get(['id','bank_name']);
        $data['purposeheads']   = PurposeHead::get(['id','name']);
        $data['farmers']        = Farmer::get(['id','name']);
        $data['companies']      = Company::get(['id','name']);
        $data['users']          = User::get(['id','name']);

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

        /* CREATE Payment */
        $payment = Payment::create([
            'bank_id'        =>      $request->input('bank_id'),
            'purposehead_id' =>      $request->input('purposehead_id'),
            'company_id'     =>      null ?? $request->input('company_id'),
            'farmer_id'      =>      null ?? $request->input('farmer_id'),
            'user_id'        =>      null ?? $request->input('user_id'),
            'payee_type'     =>      $request->input('payee_type'),
            'payment_amount' =>      $request->input('payment_amount'),
            'payment_type'   =>      $request->input('payment_type'),
            'bank_name'      =>      $request->input('bank_name'),
            'reference'      =>      $request->input('reference'),
            'received_by'    =>      $request->input('received_by'),
            'remarks'        =>      $request->input('remarks'),
            'payment_date'   =>      Carbon::parse($request->input('payment_date'))->format('Y-m-d H:i'),
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
        $data['users']          = User::get(['id','name']);

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
            'bank_id'        =>      $request->input('bank_id'),
            'purposehead_id' =>      $request->input('purposehead_id'),
            'company_id'     =>      $request->input('payee_type') === 'company' ? $request->input('company_id') : null,
            'farmer_id'      =>      $request->input('payee_type') === 'farmer' ? $request->input('farmer_id') : null,
            'user_id'        =>      $request->input('payee_type') === 'staff' ? $request->input('user_id') : null,
            'payee_type'     =>      $request->input('payee_type'),
            'payment_amount' =>      $request->input('payment_amount'),
            'payment_type'   =>      $request->input('payment_type'),
            'bank_name'      =>      $request->input('bank_name'),
            'reference'      =>      $request->input('reference'),
            'received_by'    =>      $request->input('received_by'),
            'status'         =>      $request->input('status'),
            'remarks'        =>      $request->input('remarks'),
            'payment_date'   =>      Carbon::parse($request->input('payment_date'))->format('Y-m-d'),
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
        /* Payment DELETE */
        $paymentDelete = $payment->delete();
        if($paymentDelete){
            Toastr::success('Payment Deleted Successfully', 'Success');
            return redirect()->route('admin.payment.index');
        }
        abort(404);
    }
}
