<?php


namespace App\Repository;


use App\Models\Branch;
use App\Models\StockTransfer;

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

    public function createStockTransfer()
    {
        $branches = Branch::get(['id','name']);
        return view('admin.stocks.transfer',compact('branches'));
    }
}
