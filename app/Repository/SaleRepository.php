<?php


namespace App\Repository;


use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleRepository
{
    /**
     * @var Sale
     */
    private $model;

    /**
     * SaleRepository constructor.
     * @param Sale $model
     */
    public function __construct(Sale $model)
    {

        $this->model = $model;
    }

    public function findByDay($date){
        $farmer_invoice = DB::table('farmer_invoices')
            ->select('farmer_invoices.id','farmer_invoices.user_id','farmer_invoices.farmer_id',DB::raw("''"),DB::raw("'' as branch_id"),'farmer_invoices.date as date','farmer_invoices.invoice_number as sale_no',DB::raw("'' as type"),'farmer_invoices.total_amount as sub_total',DB::raw("'0' as discount"),'farmer_invoices.total_amount as grand_total','farmer_invoices.remarks')
            ->where('farmer_invoices.date',$date);

        $sale_invoice = DB::table('sales')
            ->select('sales.id','sales.user_id',DB::raw("'' as farmer_id"),'sales.customer_id','sales.branch_id','sales.sale_date as date','sales.sale_no','sales.payment_type as type','sales.sub_total','sales.discount','sales.grand_total','sales.remarks')
            ->where('sales.sale_date',$date)
            ->unionAll($farmer_invoice)
            ->orderBy('date','desc');
        return collect($sale_invoice->get());
    }

    public function findByMonth($fromDate, $toDate)
    {
        $farmer_invoice = DB::table('farmer_invoices')
            ->select('farmer_invoices.id','farmer_invoices.user_id','farmer_invoices.farmer_id',DB::raw("''"),DB::raw("'' as branch_id"),'farmer_invoices.date as date','farmer_invoices.invoice_number as sale_no',DB::raw("'' as type"),'farmer_invoices.total_amount as sub_total',DB::raw("'0' as discount"),'farmer_invoices.total_amount as grand_total','farmer_invoices.remarks')
            ->whereBetween('farmer_invoices.date',[$fromDate, $toDate]);

        $sale_invoice = DB::table('sales')
            ->select('sales.id','sales.user_id',DB::raw("'' as farmer_id"),'sales.customer_id','sales.branch_id','sales.sale_date as date','sales.sale_no','sales.payment_type as type','sales.sub_total','sales.discount','sales.grand_total','sales.remarks')
            ->whereBetween('sales.sale_date',[$fromDate, $toDate])
            ->unionAll($farmer_invoice)
            ->orderBy('date','desc');
        return collect($sale_invoice->get());
    }

}
