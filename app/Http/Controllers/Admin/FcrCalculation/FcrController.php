<?php

namespace App\Http\Controllers\Admin\FcrCalculation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Farmer\FcrDataStoreRequest;
use App\Services\FcrCalculationService;
use App\Transforfer\FcrCalculationTransformer;
use Illuminate\Http\Request;
use DomPDF;

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
        $data['batch'] = $this->fcrCalculationService->currentBatch($this->request->id);
        if (!empty($data['batch']->batch_number))
        {
            $data['product'] = $this->fcrCalculationService->getChicksPrice($data['batch']->product_id,$data['batch']->chicks_batch_no);
            $data['records'] = $this->fcrCalculationTransformer->getRecords($this->fcrCalculationService->currentBatchRecords($data['batch']->batch_number));
        }

        return view('admin.farmer.fcr',$data);
    }

    public function store(FcrDataStoreRequest $request)
    {
        try {
            $fcr = $this->fcrCalculationService->storeData($request);
            $batchUpdate = $this->fcrCalculationService->updateActiveBatch($request->farmer_id, $request->batch_number);

            return redirect()->route('admin.farmer.show', $request->farmer_id);
        }catch (\Exception $exception)
        {

            return response()->json($this->fcrCalculationTransformer->storeFailed($exception),200);
        }

    }

    public function download($batch_number)
    {
        try {
            $data['fcr'] = $this->fcrCalculationService->getData($batch_number);
            $data['farmer'] = $this->fcrCalculationService->getFarmerData($data['fcr']->farmer_id);
            $pdf = DomPDF::loadView('admin.print.fcr',$data)->setPaper('a4', 'landscape');
            return $pdf->stream('fcr.pdf');

        }catch (\Exception $e)
        {
            return redirect()->back()->withErrors($e);
        }


    }
}
