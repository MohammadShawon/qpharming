<?php


namespace App\Services;


use App\Repository\FarmerRepository;

class FcrCalculationService
{
    /**
     * @var FarmerRepository
     */
    private $farmerRepository;

    /**
     * FcrCalculationService constructor.
     * @param FarmerRepository $farmerRepository
     */
    public function __construct(FarmerRepository $farmerRepository)
    {

        $this->farmerRepository = $farmerRepository;
    }
    public function findById($id)
    {
        return $this->farmerRepository->findById($id);
    }
}
