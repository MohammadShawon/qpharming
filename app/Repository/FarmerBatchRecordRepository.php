<?php


namespace App\Repository;


use App\Models\FarmerRecord;

class FarmerBatchRecordRepository
{
    /**
     * @var FarmerRecord
     */
    private $model;

    /**
     * FarmerBatchRecordRepository constructor.
     * @param FarmerRecord $model
     */
    public function __construct(FarmerRecord $model)
    {

        $this->model = $model;
    }

    public function currentBatchRecords($batch_number)
    {
        return $this->model->where('batch_number', $batch_number)->get();
    }
}
