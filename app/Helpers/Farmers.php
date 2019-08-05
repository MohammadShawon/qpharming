<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\FarmerBatch;
use App\Models\FarmerInvoice;
use App\Models\Payment;
use App\Models\ProductPrice;

class Farmers
{
    public static function totalCost(int $farmer_id):int
    {
        $chicksQuantity = FarmerBatch::where('farmer_id',$farmer_id)->where('status','active')->first();


        $chicks = Category::where('name','Chicks')->with('products')->first();
        $chicksPrice = [];
        foreach ($chicks->products as $product)
        {

            if (ProductPrice::where('product_id',$product->id)->where('batch_no',$chicksQuantity->chicks_batch_no)->first())
            {
                $chicksPrice = ProductPrice::where('product_id',$product->id)->where('batch_no',$chicksQuantity->chicks_batch_no)->first();
            }

        }


        $totalChicksPrice = $chicksPrice->selling_price * $chicksQuantity->chicks_quantity;
        $totalInvoiceAmount = FarmerInvoice::where('farmer_id',$farmer_id)->sum('total_amount');
        $advancePayments = Payment::where('farmer_id',$farmer_id)->sum('payment_amount');

        return ($totalChicksPrice + $totalInvoiceAmount + $advancePayments);
    }
}
