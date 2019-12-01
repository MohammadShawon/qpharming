<?php

namespace App\DataTables\Company;

use App\Models\Company;
use Yajra\DataTables\Services\DataTable;

class CompaniesDataTable extends DataTable
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
            ->editColumn('representative_name', static function ($data){
                return $data->representative_name ?? 'N/A';
            })
            ->editColumn('type',function ($type){
                return $this->getBusinessType($type);
            })
            ->editColumn('status',function ($status){
                return $this->getStatus($status);
            })
            ->addColumn('action', function ($data)
            {
                return $this->getActionColumn($data);
            })
            ->rawColumns(['type','status','action'])
            ->setRowClass('gradeX');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()->select('*');
    }

    /**
     * @param $type
     * @return String
     */
    protected function getBusinessType($type):string
    {
        switch ($type->type)
        {
            case 'feed':
                return "<span class='btn yellow btn-outline'> Feed </span>";
                break;

            case 'medicine':
                return "<span class='btn blue btn-outline'>Medicine</span>";
                break;

            case 'chick':
                return "<span class='btn purple btn-outline'>Chick</span>";
                break;
            default:
                return "<span class='btn dark btn-outline'>Other</span>";
                break;
        }
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
        $showUrl = route('admin.company.show', $data);
        $editUrl = route('admin.company.edit', $data);
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
                    ->addAction([
                        'width' => '15%',
                        'printable' => false,
                        'exportable' => false,
                        'searchable' => false
                    ])
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
    protected function getColumns():array
    {
        return [
            [
                'defaultContent' => '',
                'data'           => 'id',
                'name'           => 'id',
                'title'          => 'S. No',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'width'     => '8%',

            ],
            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Company Name',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'representative_name',
                'name' => 'representative_name',
                'title' => 'Representative Name',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'phone1',
                'name' => 'phone1',
                'title' => 'Phone Number',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'type',
                'name' => 'type',
                'title' => 'Company Type',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'opening_balance',
                'name' => 'opening_balance',
                'title' => 'Opening Balance',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => 'Status',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
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
        return 'Company/Companies_' . date('YmdHis');
    }
}
