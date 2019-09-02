<?php

namespace App\DataTables\Invoices;

use App\Models\Customer;
use App\Models\Farmer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class SaleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('date',static function($data){
                return Carbon::parse($data->date)->format('d-M-Y');
            })
            ->editColumn('customer_id',static function($data){

                return !empty($data->customer_id) ? Customer::find($data->customer_id)->phone : Farmer::find($data->farmer_id)->name;

            })
            ->editColumn('type',static function($data){
                return !empty($data->type) ? "<span class='label label-sm label-success'> {$data->type}</span>" : "<span class='label label-sm label-warning'>Credit</span>";
            })
            ->editColumn('sub_total',static function($data){
                return !empty($data->type) ? $data->sub_total : $data->grand_total;
            })
            ->editColumn('discount',static function($data){
                return !empty($data->discount) ? $data->discount : '0.00';
            })
            ->editColumn('grand_total', static function($data){
                return "<b>$data->grand_total</b>";
            })
            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
            })
            ->rawColumns(['grand_total','action','type'])
            ->setRowClass('gradeX');
    }

    /**
     * @param $data
     * @return string
     */
    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.sales.show', $data->id);
        return "<a class='btn dark btn-outline btn-circle' data-value='$data->id' href='$showUrl'><i class='material-icons'>visibility</i></a> 
                        <button class='btn red btn-outline btn-circle delete' data-value='$data->id' ><i class='material-icons'>delete</i></button>";
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $farmer_invoice = DB::table('farmer_invoices')
            ->select('farmer_invoices.id','farmer_invoices.user_id','farmer_invoices.farmer_id',DB::raw("''"),DB::raw("'' as branch_id"),'farmer_invoices.date as date','farmer_invoices.invoice_number as sale_no',DB::raw("'' as type"),'farmer_invoices.total_amount as sub_total',DB::raw("'0' as discount"),'farmer_invoices.total_amount as grand_total','farmer_invoices.remarks');

        $sale_invoice = DB::table('sales')
            ->select('sales.id','sales.user_id',DB::raw("'' as farmer_id"),'sales.customer_id','sales.branch_id','sales.sale_date as date','sales.sale_no','sales.payment_type as type','sales.sub_total','sales.discount','sales.grand_total','sales.remarks')
            ->unionAll($farmer_invoice)
            ->orderBy('date','desc');
        return $sale_invoice->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction([
                        'width' => '12%',
                        'printable' => false,
                        'exportable' => false,
                        'searchable' => false
                    ])
                    ->paging(true)
                    ->lengthMenu([[50, 100,500, -1], [50, 100,500, 'All']])
                    ->scrollX(true)
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => 'S. No',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'width'     => '8%',

            ],
            [
                'data'    => 'id',
                'name'    => 'id',
                'title'   => 'ID No.',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'visible' => false
            ],
            [
                'data'    => 'date',
                'name'    => 'date',
                'title'   => 'Date',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'branch_id',
                'name'    => 'branch_id',
                'title'   => 'Branch',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'visible' => false
            ],
            [
                'data'    => 'sale_no',
                'name'    => 'sale_no',
                'title'   => 'Inv-No.',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible'        => true,
                'width'          => '10%'
            ],
            [
                'data'    => 'customer_id',
                'name'    => 'company_id',
                'title'   => 'Name',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true,
            ],
            [
                'data'    => 'type',
                'name'    => 'type',
                'title'   => 'Paid Type',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'sub_total',
                'name'    => 'sub_total',
                'title'   => 'Sub Total',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'discount',
                'name'    => 'discount',
                'title'   => 'Discount',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'grand_total',
                'name'    => 'grand_total',
                'title'   => 'Grand Total',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'user_id',
                'name'    => 'user_id',
                'title'   => 'ID No.',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'visible' => false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'InvoicesSale_' . date('YmdHis');
    }
}
