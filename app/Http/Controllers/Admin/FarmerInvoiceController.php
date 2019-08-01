<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Farmer;
use App\Models\FarmerInvoice;
use App\Models\Payment;
use App\Models\PurposeHead;
use App\Models\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmerInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.farmerinvoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['farmer'] = Farmer::find($id);
        $data['invoice'] = FarmerInvoice::orderBy('id','DESC')->first();
        $data['banks']          = Bank::get(['id','bank_name']);
        $data['purposeheads']   = PurposeHead::get(['id','name']);
        return view('admin.farmerinvoice.create',$data);
    }


    public function payment(Request $request,$id)
    {

        $payment = Payment::create([
            'bank_id'        =>      1,
            'purposehead_id' =>      $request->input('purposehead_id'),
            'company_id'     =>      null,
            'farmer_id'      =>      $id,
            'user_id'        =>      null,
            'payee_type'     =>      'farmer',
            'payment_amount' =>      $request->input('payment_amount'),
            'payment_type'   =>      'cash',
            'bank_name'      =>      null,
            'reference'      =>      $request->input('reference'),
            'received_by'    =>      $request->input('received_by'),
            'remarks'        =>      'Advance Payment',
            'payment_date'   =>      Carbon::parse($request->input('payment_date'))->format('Y-m-d H:i'),
        ]);
        /* Check Payment insertion  and Toastr */
        if($payment){
            Toastr::success('Farmer Payment Successfully', 'Success');
            return redirect()->to('farmer/'.$id.'/invoice');
        }

        Toastr::error('Farmer Payment Successfully', 'Error');
        return redirect()->to('farmer/'.$id.'/invoice');


    }

    /**
     * Get Sale No with Prefix 00
     * @return int
     */
    protected function getInvoiceNo()
    {


        $invoiceId = FarmerInvoice::orderBy('id','DESC')->first();
        if ($invoiceId)
        {
            $id = $invoiceId->id +1;
            return sprintf('%1$03d',$id);
        }else{
            return sprintf('%1$03d',1);
        }


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
