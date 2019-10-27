<?php

namespace App\Http\Controllers\Admin\Stocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockTransferStoreRequest;
use App\Services\StockTransferService;
use App\Transforfer\StockTransferTransformer;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{
    /**
     * @var StockTransferTransformer
     */
    private $stockTransferTransformer;
    /**
     * @var StockTransferService
     */
    private $stockTransferService;

    /**
     * StockTransferController constructor.
     * @param StockTransferTransformer $stockTransferTransformer
     * @param StockTransferService $stockTransferService
     */
    public function __construct(StockTransferTransformer $stockTransferTransformer, StockTransferService $stockTransferService)
    {

        $this->stockTransferTransformer = $stockTransferTransformer;
        $this->stockTransferService = $stockTransferService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createStockTransfer()
    {
        return $this->stockTransferService->createStockTransfer();
    }

    /**
     * @param StockTransferStoreRequest $request
     * @return StockTransferStoreRequest
     */
    public function transfer(StockTransferStoreRequest $request)
    {
        return $this->stockTransferService->transfer($request);
    }
}
