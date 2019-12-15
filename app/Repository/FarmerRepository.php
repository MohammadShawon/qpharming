<?php


namespace App\Repository;


use App\Models\Farmer;

class FarmerRepository
{
    /**
     * @var Farmer
     */
    private $model;

    /**
     * FarmerRepository constructor.
     * @param Farmer $model
     */
    public function __construct(Farmer $model)
    {

        $this->model = $model;
    }
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }


}
