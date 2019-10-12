<?php

namespace App\DataTables\Records;

use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class CompanyRecordsDataTable extends DataTable
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
            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
            })
            ->rawColumns(['action'])
            ->setRowClass(function ($data){
                return $data->PurchaseNo === 'Payment' ? 'alert-success' : 'alert-danger';
            });
    }

    /**
     * @param $data
     * @return string
     */
    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.purchases.show', $data->id);

        return $data->PurchaseNo === 'Payment' ? "<a class='btn dark btn-outline btn-circle disabled' data-value='$data->id' href='$showUrl'><i class='material-icons'>visibility</i></a>" : "<a class='btn dark btn-outline btn-circle' data-value='$data->id' href='$showUrl'><i class='material-icons'>visibility</i></a>";
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $purchase = DB::table('purchases')
            ->rightJoin('purchase_payments','purchases.id','=','purchase_payments.purchase_id')
            ->select('purchases.id','purchases.purchase_no as PurchaseNo','purchases.purchase_date as date','purchases.payment_type as type','purchases.grand_total','purchase_payments.payment as payment','purchases.remarks')
            ->where('purchases.company_id','=',$this->company_id);

        $payment = DB::table('payments')
                    ->select('payments.id',DB::raw("'Payment' as PurchaseNo"),'payment_date as date','payment_type as type',DB::raw("'N/A' as 'grand_total'"),'payment_amount as payment','remarks')
                    ->where('company_id','=',$this->company_id)
                    ->unionAll($purchase)
                    ->orderBy('date','desc');


        return $payment->get();
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
                    ->processing(true)
                    ->paging(true)
                    ->lengthMenu([[50, 100,500, -1], [50, 100,500, 'All']])
                    ->parameters($this->getBuilderParameters())
                    ->scrollX(true);
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
                'data'  => 'date',
                'name'  => 'date',
                'title' => 'Date',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
                'width'     => '15%'
            ],
            [
                'data'  => 'PurchaseNo',
                'name'  => 'PurchaseNo',
                'title' => 'Purchase No.',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
            ],
            [
                'data'  => 'type',
                'name'  => 'type',
                'title' => 'Type',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
            ],
            [
                'data'  => 'grand_total',
                'name'  => 'grand_total',
                'title' => 'Invoice Amount',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
            ],
            [
                'data'  => 'payment',
                'name'  => 'payment',
                'title' => 'Payment',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
            ],
            [
                'data'  => 'remarks',
                'name'  => 'remarks',
                'title' => 'Remarks',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
            ]

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CompanyRecords_' . date('YmdHis');
    }
}
