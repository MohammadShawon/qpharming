<?php

namespace App\DataTables\Product;

use App\Models\Product;
use App\Models\ProductPrice;
use App\User;
use Yajra\DataTables\Services\DataTable;
use \DB;

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
            ->addColumn('quantity',static function ($data){
                $quantity = ProductPrice::select(DB::raw('sum(quantity - sold) as current_quantity'))->where('product_id',$data->id)->first();
                return $quantity->current_quantity;
            })
            ->editColumn('subcategory_id',function ($data){
                return $data->subcategory->category->name . '->' . $data->subcategory->name;
            })
            ->editColumn('company_id',function ($data){
                return $data->company->name ?? 'N/A';
            })
            ->editColumn('base_unit_id', function($data){
                return $data->unit->name;
            })

            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
            })
            ->rawColumns(['action','intro','quantity'])
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
        return $model->newQuery()->select('id', 'subcategory_id','company_id','sku','product_name','barcode','base_unit_id','description','size', 'created_at', 'updated_at');
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
                        'width' => '16%',
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
                'data' => 'company_id',
                'name' => 'company_id',
                'title' => 'Company Name',
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
                'data'        => 'quantity',
                'name'        => 'quantity',
                'title'       => 'Stock',

            ],

//            [
//                'data' => 'barcode',
//                'name' => 'barcode',
//                'title' => 'Barcode No',
//                'searchable' => true,
//                'visible' => true,
//                'orderable' => true
//            ],
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
                'visible' => false,
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

    /**
     * @return array
     */
    protected function getBuilderParameters():array
    {
        return[
            'dom'     => 'Blfrtip',
            'order'   => [[0, 'desc']],
            'buttons' => [
                'create',
                'excel',
                'csv',
                'pdf',
                'print'

            ],

        ];
    }
}
