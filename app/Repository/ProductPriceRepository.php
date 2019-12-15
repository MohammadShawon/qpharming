<?php


namespace App\Repository;


use App\Models\ProductPrice;

class ProductPriceRepository
{
    /**
     * @var ProductPrice
     */
    private $model;

    /**
     * ProductPriceRepository constructor.
     * @param ProductPrice $model
     */
    public function __construct(ProductPrice $model)
    {

        $this->model = $model;
    }

    public function getChicksPrice($product_id, $chicks_batch_no)
    {
        return $this->model->select('selling_price')->where('product_id', $product_id)->where('batch_no', $chicks_batch_no)->first();
    }
}
