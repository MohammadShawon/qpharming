<?php

namespace App\DataTables\Subcategory;


use Yajra\DataTables\Services\DataTable;
use App\Models\SubCategory;

class SubcategoryDatatables extends DataTable
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
            ->editColumn('category_id', function($category)
            {
                return $category->category->name;
            })
            ->addColumn('action', function($data)
            {
            return "
            <a class='waves-effect  btn btn-primary edit' data-value='$data->id' href='/sub-category/$data->id/edit'>Update</a>
            <a class='waves-effect btn deepPink-bgcolor delete' data-value='$data->id' >Delete</a>";
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubCategory $model)
    {
        return $model->newQuery()->select('id', 'category_id','name', 'created_at',);
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
                    ->addAction(['width' => '80px'])
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
                'data'  => 'id',
                'name'  => 'id',
                'title' => 'Serial',
                'orderable' => true,
                'searchable' => true,
                'visible' => true,
            ],
            [
                'data'  => 'category_id',
                'name'  => 'category_id',
                'title' => 'Category Name',
                'orderable' => true,
                'searchable' => true,
                'visible' => true,
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => 'Category Name',
                'orderable' => true,
                'searchable' => true,
                'visible' => true,
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
        return 'Subcategory/SubcategoryDatatables_' . date('YmdHis');
    }

    protected function getBuilderParameters()
    {
        return parent::getBuilderParameters();
    }
}
