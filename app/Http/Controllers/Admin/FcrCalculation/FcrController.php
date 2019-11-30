<?php

namespace App\Http\Controllers\Admin\FcrCalculation;

use App\Http\Controllers\Controller;
use App\Services\FcrCalculationService;
use App\Transforfer\FcrCalculationTransformer;
use Illuminate\Http\Request;

class FcrController extends Controller
{
    /**
     * @var FcrCalculationService
     */
    private $fcrCalculationService;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var FcrCalculationTransformer
     */
    private $fcrCalculationTransformer;

    /**
     * FcrController constructor.
     * @param FcrCalculationService $fcrCalculationService
     * @param Request $request
     * @param FcrCalculationTransformer $fcrCalculationTransformer
     */
    public function __construct(FcrCalculationService $fcrCalculationService, Request $request, FcrCalculationTransformer $fcrCalculationTransformer)
    {

        $this->fcrCalculationService = $fcrCalculationService;
        $this->request = $request;
        $this->fcrCalculationTransformer = $fcrCalculationTransformer;
    }
    public function index()
    {
        $data['farmer'] = $this->fcrCalculationService->findById($this->request->id);
        return view('admin.farmer.fcr',$data);
    }
}
