<?php


namespace App\Repository;


use App\Models\FarmerBatch;

class FarmerBatchRepository
{
    /**
     * @var FarmerBatch
     */
    private $model;

    /**
     * FarmerBatchRepository constructor.
     * @param FarmerBatch $model
     */
    public function __construct(FarmerBatch $model)
    {

        $this->model = $model;
    }

    public function currentBatch($farmer_id)
    {
        return $this->model->where('farmer_id', $farmer_id)->where('status','active')->first();
    }


}
