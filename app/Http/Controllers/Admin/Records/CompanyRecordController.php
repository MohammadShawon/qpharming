<?php

namespace App\Http\Controllers\Admin\Records;

use App\DataTables\Records\CompanyDataTable;
use App\DataTables\Records\CompanyRecordsDataTable;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompanyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CompanyRecordsDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDataTable $dataTable)
    {
        return $dataTable->render('admin.records.company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param int $id
     * @param CompanyRecordsDataTable $dataTable
     * @return void
     */
    public function show($id,CompanyRecordsDataTable $dataTable)
    {
//        dd($dataTable->query());
        $data['company'] = Company::findOrFail($id);
        $purchase = DB::table('purchases')
            ->rightJoin('purchase_payments','purchases.id','=','purchase_payments.purchase_id')
            ->select('purchases.purchase_no as PurchaseNo','purchases.purchase_date as date','purchases.payment_type as type','purchases.grand_total','purchase_payments.payment as payment','purchases.remarks')
            ->where('purchases.company_id','=',$id);

        $data['records'] = DB::table('payments')
            ->select(DB::raw("'Payment' as PurchaseNo"),'payment_date as date','payment_type as type',DB::raw("'0' as 'grand_total'"),'payment_amount as payment','remarks')
            ->where('company_id','=',$id)
            ->unionAll($purchase)
            ->orderBy('date','desc')
            ->get();
//        dd($data['records']);
        return $dataTable->with(['company_id' => $id])->render('admin.records.singlecompany',$data);
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
