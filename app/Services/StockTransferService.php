<?php


namespace App\Services;


use App\Http\Requests\Stock\StockTransferStoreRequest;
use App\Repository\StockTransferRepository;

class StockTransferService
{
    /**
     * @var StockTransferRepository
     */
    private $stockTransferRepository;

    /**
     * StockTransferService constructor.
     * @param StockTransferRepository $stockTransferRepository
     */
    public function __construct(StockTransferRepository $stockTransferRepository)
    {

        $this->stockTransferRepository = $stockTransferRepository;
    }

    public function createStockTransfer()
    {
        return $this->stockTransferRepository->createStockTransfer();
    }

    /**
     * @param StockTransferStoreRequest $request
     */
    public function transfer(StockTransferStoreRequest $request)
    {
        return $request;
    }


}
