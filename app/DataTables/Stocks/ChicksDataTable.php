<?php

namespace App\DataTables\Stocks;

use App\Models\ProductPrice;
use \DB;
use Yajra\DataTables\Services\DataTable;

class ChicksDataTable extends DataTable
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
            ->addColumn('quantity',static function($data){
                $batch = ProductPrice::where('product_id',$data->id)->get();
                $stock = $batch->sum('quantity');
                return "<span style='border: #0cc745 2px solid;padding: 10px'><b>{$stock}</b></span>";
            })
            ->addColumn('stock',static function($data){
                $batch = ProductPrice::where('product_id',$data->id)->get();
                $stock = $batch->sum('quantity') - $batch->sum('sold');
                return "<span style='border: #0cc745 2px solid;padding: 10px'><b>{$stock}</b></span>";
            })
            ->addColumn('action', 'stocks/chicksdatatable.action')
            ->rawColumns(['stock','quantity']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $chicks = DB::table('products')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->select('products.id','products.product_name')
            ->where('categories.name','=','Chicks')
            ;
        return $chicks->get();
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
                'title'          => 'Serial No',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'width'     => '12%',

            ],
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => 'Serial NO',
                'searchable' => true,
                'visible' => false,
                'orderable' => false,
                'width'     => '15%',
                'exportable'     => false,
                'printable'      => false,
            ],
            [
                'data'  => 'product_name',
                'name'  => 'product_name',
                'title' => 'Product Name',
                'searchable' => true,
                'visible' => true,
                'orderable' => true,
            ],
            [
            'data'  => 'stock',
            'name'  => 'stock',
            'title' => 'Stock',
            'searchable' => true,
            'visible' => true,
            'orderable' => true,
            ],
            [
                'data'  => 'quantity',
                'name'  => 'quantity',
                'title' => 'Quantity',
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
        return 'Stocks_Chicks_' . date('YmdHis');
    }
}
