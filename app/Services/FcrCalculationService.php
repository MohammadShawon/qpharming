<?php


namespace App\Services;


use App\Repository\FarmerBatchRecordRepository;
use App\Repository\FarmerBatchRepository;
use App\Repository\FarmerRepository;
use App\Repository\ProductPriceRepository;

class FcrCalculationService
{
    /**
     * @var FarmerRepository
     */
    private $farmerRepository;
    /**
     * @var FarmerBatchRepository
     */
    private $batchRepository;
    /**
     * @var FarmerBatchRecordRepository
     */
    private $batchRecordRepository;
    /**
     * @var ProductPriceRepository
     */
    private $productPriceRepository;

    /**
     * FcrCalculationService constructor.
     * @param FarmerRepository $farmerRepository
     * @param FarmerBatchRepository $batchRepository
     * @param FarmerBatchRecordRepository $batchRecordRepository
     * @param ProductPriceRepository $productPriceRepository
     */
    public function __construct(FarmerRepository $farmerRepository, FarmerBatchRepository $batchRepository,FarmerBatchRecordRepository $batchRecordRepository, ProductPriceRepository $productPriceRepository)
    {

        $this->farmerRepository = $farmerRepository;
        $this->batchRepository = $batchRepository;
        $this->batchRecordRepository = $batchRecordRepository;
        $this->productPriceRepository = $productPriceRepository;
    }
    public function findById($id)
    {
        return $this->farmerRepository->findById($id);
    }

    public function currentBatch($farmer_id)
    {
        return $this->batchRepository->currentBatch($farmer_id);
    }

    public function currentBatchRecords($batch_number)
    {
        return $this->batchRecordRepository->currentBatchRecords($batch_number);
    }

    public function getChicksPrice($product_id, $chicks_batch_no)
    {
        return $this->productPriceRepository->getChicksPrice($product_id, $chicks_batch_no);
    }
}
