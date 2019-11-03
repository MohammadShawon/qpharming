<?php


namespace App\Repository;


use App\Models\Branch;
use App\Models\Product;
use App\Models\StockTransfer;
use Illuminate\Support\Facades\DB;

class StockTransferRepository
{
    /**
     * @var StockTransfer
     */
    private $model;

    /**
     * StockTransferRepository constructor.
     * @param StockTransfer $model
     */
    public function __construct(StockTransfer $model)
    {

        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function createStockTransfer()
    {
        /**
         *  Branch List without logged in user
         */
        $data['branches'] = Branch::whereNotIn('id',[auth()->user()->branch_id])->get(['id','name']);
        $data['products'] = Product::cursor(['id','product_name']);
        return $data;
    }

    public function store($request)
    {
        return $request;
    }

    /**
     * @param $product_id
     * @return \Illuminate\Support\Collection
     */
    public function productAllBatch($product_id): \Illuminate\Support\Collection
    {
        return DB::table('product_prices')->selectRaw('id,product_id,batch_no,quantity,sold,sum(quantity - sold) stock')->whereRaw('quantity - sold > 0')->where('product_id',$product_id)->groupBy('batch_no')->orderBy('created_at')->get();
    }
}
