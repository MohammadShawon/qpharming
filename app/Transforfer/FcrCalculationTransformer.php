<?php


namespace App\Transforfer;


use function foo\func;

class FcrCalculationTransformer
{

    public function getRecords($currentBatchRecords)
    {
       return [
           'total_died' => $currentBatchRecords->sum('child_death'),
           'total_feed_eaten_kg' => $currentBatchRecords->sum('feed_eaten_kg'),

       ];

    }

    public function fcrStored($fcr)
    {
        return ResponseTransformer::successResponse(201, 'Stored Fcr Data', [
            'fcr' => $fcr
        ]);
    }

    public function storeFailed($exception)
    {
        return ResponseTransformer::errorResponse(404, 'Error Response', [
           'error' => $exception->getMessage()
        ]);
    }


}
