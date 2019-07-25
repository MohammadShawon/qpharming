<?php

namespace App\DataTables\Farmers;

use App\Models\Farmer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html;
use Yajra\DataTables\DataTables;
use \DB;

class BranchFarmersDatatables extends DataTable
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
            ->editColumn('status',function ($status){
                return $this->getStatus($status);
            })
            ->addColumn('action', function ($data){
                return $this->getActionColumn($data);
            })
            ->rawColumns(['status','action'])
            ->setRowClass('gradeX');
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Farmer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Farmer $model)
    {
        return $model->newQuery()->select('id', 'branch_id','name','phone1','phone2','address','opening_balance','starting_date','ending_date','status', 'created_at', 'updated_at')->where('branch_id',$this->branch_id);
    }

    /**
     * @param $status
     * @return string
     */
    protected function getStatus($status):string
    {
        if ($status->status === 'active'){
            return "<span class='btn btn-circle btn-success'> Active </span>";
        }
        elseif ($status->status === 'inactive'){
            return "<span class='btn btn-circle btn-danger'> InActive </span>";
        }else
        {
            return "<span class='btn btn-circle btn-danger disabled'> Disabled </span>";
        }

    }

    /**
     * @param $data
     * @return string
     */
    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.farmer.show', $data->id);
        $editUrl = route('admin.farmer.edit', $data->id);
        return "<a class='btn dark btn-outline btn-circle' data-value='$data->id' href='$showUrl'><i class='material-icons'>visibility</i></a> 
                        <a class='btn blue btn-outline btn-circle' data-value='$data->id' href='$editUrl'><i class='material-icons'>edit</i></a>
                        <button class='btn red btn-outline btn-circle delete' data-value='$data->id' ><i class='material-icons'>delete</i></button>";
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
                    ->processing(true)
                    ->addAction([
                        'width' => '15%',
                        'printable' => false,
                        'exportable' => false,
                        'searchable' => false
                    ])
                    ->paging(true)
                    ->lengthMenu([[50, 100,500, -1], [50, 100,500, 'All']])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns():array
    {
        return [

                [
                    'data'  => 'name',
                    'name'  => 'name',
                    'title' => 'Farmer Name',
                    'searchable' => true,
                    'visible' => true,
                    'orderable' => true
                ],
                [
                    'data'  => 'phone1',
                    'name'  => 'phone1',
                    'title' => 'Phone Number'
                ],
                [
                    'data'  => 'address',
                    'name'  => 'address',
                    'title' => 'Address',
                    'visible' => true
                ],
                [
                    'data'  => 'opening_balance',
                    'name'  => 'opening_balance',
                    'title' => 'Opening Balance',

                ],
                [
                    'data'  => 'status',
                    'name'  => 'status',
                    'title' => 'Status',
                    'printable' => false,
                    'exportable' => false,
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
        return 'BranchFarmersDatatables_' . date('YmdHis');
    }
}
