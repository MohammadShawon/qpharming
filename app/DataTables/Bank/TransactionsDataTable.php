<?php

namespace App\DataTables\Bank;

use App\Models\Company;
use App\Models\Farmer;
use App\Models\PurposeHead;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
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
            ->editColumn('Heads',static function ($data)
            {

                return !empty($data->Heads) ? PurposeHead::find($data->Heads)->name : 'N/A';

            })
            ->editColumn('Company',static function ($data){
                return !empty($data->Company) ? Company::find($data->Company)->company_name : 'N/A';
            })
            ->editColumn('farmer_id',static function ($data) {
                return !empty($data->farmer_id) ? Farmer::find($data->farmer_id)->name : 'N/A';
            })
            ->editColumn('Employee',static function($data) {
                return !empty($data->Employee) ? User::find($data->Employee)->name : 'N/A';
            })
            ->editColumn('Date', static function($data){
                return Carbon::parse($data->Date)->format('d-m-Y');
            })
            ->editColumn('Amount', static function($data){
                return $data->Origin === 'Collection' ? '+ '.$data->Amount : '- '.$data->Amount;
            })
            ->setRowClass(function ($data){
                return $data->Origin === 'Collection' ? 'alert-success' : 'alert-danger';
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $payment = DB::table('payments')
            ->select('payments.purposehead_id as Heads','payments.company_id as Company','payments.farmer_id','payments.user_id as Employee','payments.payee_type as Category','payments.payment_amount as Amount','payments.payment_type as Type','payments.bank_name','payments.reference','payments.received_by as Recipient','payments.remarks','payments.payment_date as Date',DB::raw("'Payments' as Origin"));

        $collection =DB::table('collections')
            ->select(DB::raw("'' as Heads"),DB::raw("'' as Company"),'collections.farmer_id',DB::raw("'' as Employee"),'collections.collect_type as Category','collections.collection_amount as Amount','collections.collection_type as Type','collections.bank_name','collections.reference','collections.given_by as Recipient','collections.remarks','collections.collection_date as Date',DB::raw("'Collection' as Origin"))
            ->unionAll($payment)
            ->orderBy('Date','desc');
        return $collection->get();
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
                'data'  => 'Date',
                'name'  => 'Date',
                'title' => 'Date',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
                'width'     => '15%'
            ],
            [
                'data'  => 'Origin',
                'name'  => 'Origin',
                'title' => 'Origin',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data'  => 'Heads',
                'name'  => 'Heads',
                'title' => 'Purpose Head',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data'  => 'Company',
                'name'  => 'Company',
                'title' => 'Company',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data'  => 'farmer_id',
                'name'  => 'farmer_id',
                'title' => 'Farmer Name',
                'visible' => true
            ],
            [
                'data'  => 'Employee',
                'name'  => 'Employee',
                'title' => 'Employee',
                'visible' => true
            ],
            [
                'data'  => 'Category',
                'name'  => 'Category',
                'title' => 'Category',
                'visible' => true
            ],
            [
                'data'  => 'Amount',
                'name'  => 'Amount',
                'title' => 'Amount',
                'visible' => true
            ],
            [
                'data'  => 'Type',
                'name'  => 'Type',
                'title' => 'Type',
                'visible' => false,
                'printable' => false,
                'exportable' => false,
            ],
            [
                'data'  => 'reference',
                'name'  => 'reference',
                'title' => 'Reference',
                'visible' => false,
                'searchable' => true,
            ],
            [
                'data'  => 'Recipient',
                'name'  => 'Recipient',
                'title' => 'Recipient',
                'visible' => true,

            ],
            [
                'data'  => 'remarks',
                'name'  => 'remarks',
                'title' => 'Remarks',
                'visible' => true
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
        return 'Bank/Transactions_' . date('YmdHis');
    }
}
