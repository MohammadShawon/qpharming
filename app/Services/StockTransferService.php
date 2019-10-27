<?php


namespace App\Services;


use App\Http\Requests\Stock\StockTransferStoreRequest;
use App\Models\ProductPrice;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createStockTransfer()
    {
        /** @var array $data */
        $data = $this->stockTransferRepository->createStockTransfer();
        return view('admin.stocks.transfer', $data);
    }

    /**
     * @param StockTransferStoreRequest $request
     * @return
     */
    public function transfer(StockTransferStoreRequest $request)
    {
        try {
//            $this->stockTransferRepository->store($request);
            return $this->removeQuantityFromMainBranch($request);
        } catch (\Exception $e) {
            return session()->flash($e->getMessage());
        }

    }

    /**
     * @param $request
     *
     */
    private function removeQuantityFromMainBranch($request)
    {

        $product = ProductPrice::where('product_id', $request->product_id)->first();
        return $product->quantity - $product->sold  ;
        if ($request->quantity > ($product->quantity - $product->sold)) {

            $productAllBatch = $this->stockTransferRepository->productAllBatch($request->product_id);


            $updateQuantity = 0;
            $totalUpdate = 0;
            foreach ($productAllBatch as $value) {
                $updateQuantity += $value->stock;

                if ($updateQuantity <= ($request->quantity - $totalUpdate)) {
                    $singleBatch = ProductPrice::find($value->id);
                    $singleBatch->update(array('sold' => $value->sold + $value->stock));
                    $totalUpdate += $value->stock;
                }


            }

            if (($request->quantity - $totalUpdate) !== 0) {
                $singleBatch = ProductPrice::where('product_id', $request->product_id)->whereRaw('quantity - sold > 0')->first();
                $singleBatch->update(array('sold' => $value->sold + ($request->quantity - $totalUpdate)));

            }

        }


    }
}
