<?php


namespace App\Repository;


use App\Models\Purchase;

class PurchaseRepository
{
    /**
     * @var Purchase
     */
    private $model;

    /**
     * PurchaseRepository constructor.
     * @param Purchase $model
     */
    public function __construct(Purchase $model)
    {

        $this->model = $model;
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function findByDay(string $date)
    {
        return $this->model->where('purchase_date',$date)->get();
    }

    public function findByMonth(string $fromDate, string $toDate)
    {
        return $this->model->whereBetween('purchase_date',[$fromDate, $toDate])->get();
    }
}
