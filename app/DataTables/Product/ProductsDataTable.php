<?php

namespace App\DataTables\Product;

use App\Models\Product;
use App\User;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->editColumn('subcategory_id',function ($data){
                return $data->subcategory->category->name . '->' . $data->subcategory->name;
            })
            ->editColumn('base_unit_id', function($data){
                return $data->unit->name;
            })

            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
            })
            ->rawColumns(['action','intro'])
            ->setRowClass('gradeX');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->select('id', 'subcategory_id','sku','product_name','barcode','base_unit_id','description','size', 'created_at', 'updated_at');
    }


    /**
     * @param $data
     * @return string
     */
    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.product.show', $data->product_name);
        $editUrl = route('admin.product.edit', $data->product_name);
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
    protected function getColumns()
    {
        return [
            [
                'data' => 'sku',
                'name' => 'sku',
                'title' => 'Sku Number',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'product_name',
                'name' => 'product_name',
                'title' => 'Product Name',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'subcategory_id',
                'name' => 'subcategory_id',
                'title' => 'Category',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],

            [
                'data' => 'barcode',
                'name' => 'barcode',
                'title' => 'Barcode No',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'base_unit_id',
                'name' => 'base_unit_id',
                'title' => 'Unit',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'size',
                'name' => 'size',
                'title' => 'Size',
                'searchable' => true,
                'visible' => true,
                'orderable' => true
            ],
            [
                'data' => 'description',
                'name' => 'description',
                'title' => 'Description',
                'searchable' => false,
                'visible' => true,
                'orderable' => false
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
        return 'Products_' . date('YmdHis');
    }
}
