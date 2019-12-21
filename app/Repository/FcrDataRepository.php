<?php


namespace App\Repository;


use App\Models\FcrData;

class FcrDataRepository
{
    /**
     * @var FcrData
     */
    private $model;

    /**
     * FcrDataRepository constructor.
     * @param FcrData $model
     */
    public function __construct(FcrData $model)
    {

        $this->model = $model;
    }

    public function storeData($request)
    {
        $fcrData = new $this->model;
        $fcrData->farmer_id                 = $request->farmer_id;
        $fcrData->user_id                   = auth()->user()->id;
        $fcrData->batch_number              = $request->batch_number;
        $fcrData->given_chicks_quantity     = $request->given_chicks_quantity;
        $fcrData->chicks_rate               = $request->chicks_rate;
        $fcrData->sold_quantity             = $request->sold_quantity;
        $fcrData->sold_kg                   = $request->sold_kg;
        $fcrData->average_weight            = $request->average_weight;
        $fcrData->farm_loose_quantity       = $request->farm_loose_quantity;
        $fcrData->farm_loose_kg             = $request->farm_loose_kg;
        $fcrData->farm_stock_quantity       = $request->farm_stock_quantity;
        $fcrData->farm_stock_kg             = $request->farm_stock_kg;
        $fcrData->cartoon_dead              = $request->cartoon_dead;
        $fcrData->farm_dead                 = $request->farm_dead;
        $fcrData->missing_quantity          = $request->missing_quantity;
        $fcrData->missing_kg                = $request->missing_kg;
        $fcrData->bonus_chicks              = $request->bonus_chicks;
        $fcrData->bonus_chicks_money        = $request->bonus_chicks_money;
        $fcrData->excess_dead               = $request->excess_dead;
        $fcrData->farm_loose_cutting        = $request->farm_loose_cutting;
        $fcrData->farm_stock_cutting        = $request->farm_stock_cutting;
        $fcrData->excess_dead_cutting       = $request->excess_dead_cutting;
        $fcrData->missing_chicks_cutting    = $request->missing_chicks_cutting;
        $fcrData->excess_feed_cutting       = $request->excess_feed_cutting;
        $fcrData->report_book_cutting       = $request->report_book_cutting;
        $fcrData->transport_cost            = $request->transport_cost;
        $fcrData->stamp_cost                = $request->stamp_cost;
        $fcrData->advance_payment           = $request->advance_payment;
        $fcrData->previous_due              = $request->previous_due;
        $fcrData->others_cutting            = $request->others_cutting;
        $fcrData->feed_eaten_sacks          = $request->feed_eaten_sacks;
        $fcrData->fcr                       = $request->fcr;
        $fcrData->commission_rate           = $request->commission_rate;
        $fcrData->selling_rate              = $request->selling_rate;
        $fcrData->farm_loose_rate           = $request->farm_loose_rate;
        $fcrData->sub_total                 = $request->sub_total;
        $fcrData->total_cutting_amount      = $request->total_cutting_amount;
        $fcrData->grand_total               = $request->grand_total;
        $fcrData->save();

        return $fcrData;

    }

    public function getData($batch_number)
    {
        return  $this->model->where('batch_number', $batch_number)->first();

    }

}
