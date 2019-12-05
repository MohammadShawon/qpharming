<?php

namespace App\DataTables\Invoices;

use App\Models\Purchase;
use App\User;
use Yajra\DataTables\Services\DataTable;
use function foo\func;

class PurchaseDataTable extends DataTable
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
            ->editColumn('company_id',static function($data){
                return $data->company->name;
            })
            ->editColumn('grand_total',static function($data){
                return "<b>{$data->grand_total}</b>";
            })
            ->editColumn('payment_type',static function($data){
                return "<span class='label label-sm label-success'>$data->payment_type</span>";
            })
            ->addColumn('action',function ($data){
                if (auth()->user()->hasRole('superadmin')){
                    return $this->getActionColumn($data);
                }
                return $this->getViewColumn($data);
            })
            ->rawColumns(['grand_total','action','payment_type'])
            ->setRowClass('gradeX');
    }

    /**
     * @param $data
     * @return string
     */
    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.purchases.show', $data->id);
        $deleteUrl = route('admin.purchases.destroy', $data->id);
        $csrf = csrf_token();
        return "<a class='btn dark btn-outline btn-circle' data-value='$data->id' href='$showUrl'><i class='material-icons'>visibility</i></a>
                        <button class='btn red btn-outline btn-circle delete' type='submit' data-value='$data->id' onclick='deleteInvoice($data->id)' ><i class='material-icons'>delete</i></button>
                        <form id='delete-form-{$data->id}' action='{$deleteUrl}' method='post' style='display:none;'>
                                            <input type='hidden' name='_token' value='{$csrf}'>
                                            <input type='hidden' name='_method' value='DELETE'>
                                        </form>";
    }

    /**
     * @param $data
     * @return string
     */
    protected function getViewColumn($data): string
    {
        $showUrl = route('admin.purchases.show', $data->id);
        return "<a class='btn dark btn-outline btn-circle' data-value='$data->id' href='$showUrl'><i class='material-icons'>visibility</i></a>";

    }

    /**
     * Get query source of dataTable.
     *
     * @param Purchase $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Purchase $model)
    {
        return $model->newQuery()->select('id', 'user_id','company_id','purchase_no','purchase_date','payment_type','sub_total','discount','grand_total','status','remarks', 'created_at', 'updated_at')->orderBy('purchase_date','desc');
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
                'data'    => 'purchase_date',
                'name'    => 'purchase_date',
                'title'   => 'Date',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'purchase_no',
                'name'    => 'purchase_no',
                'title'   => 'Inv-No.',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'company_id',
                'name'    => 'company_id',
                'title'   => 'Company',
                'orderable'      => true,
                'searchable'     => true,
                'exportable'     => true,
                'printable'      => true,
                'visible' => true
            ],
            [
                'data'    => 'payment_type',
                'name'    => 'payment_type',
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
        return 'InvoicesPurchase_' . date('YmdHis');
    }
}
