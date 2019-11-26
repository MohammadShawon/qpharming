<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\FarmerBatch;
use App\Models\FarmerInvoice;
use App\Models\FarmerRecord;
use App\Models\Payment;
use App\Models\ProductPrice;
use App\Models\Farmer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Object_;

class Farmers
{
    public static function totalCost(int $farmer_id):float
    {
        $chicksQuantity = FarmerBatch::where('farmer_id',$farmer_id)->where('status','active')->first();

        if($chicksQuantity !== null)
        {
            $chicks = Category::where('name','Chicks')->with('products')->first();
            $chicksPrice = [];
            foreach ($chicks->products as $product)
            {
                if (ProductPrice::where('product_id',$product->id)->where('batch_no',$chicksQuantity->chicks_batch_no)->first())
                {
                    $chicksPrice = ProductPrice::where('product_id',$product->id)->where('batch_no',$chicksQuantity->chicks_batch_no)->first();
                }
            }

            $opening_balance = Farmer::where('id',$farmer_id)->sum('opening_balance');
            $totalChicksPrice = $chicksPrice->selling_price * $chicksQuantity->chicks_quantity;
            $totalInvoiceAmount = FarmerInvoice::where('farmer_id',$farmer_id)->sum('total_amount');
            $advancePayments = Payment::where('farmer_id',$farmer_id)->sum('payment_amount');
            return ($totalChicksPrice + $totalInvoiceAmount + $advancePayments + $opening_balance);
        }
        $opening_balance = Farmer::where('id',$farmer_id)->sum('opening_balance');
        $totalInvoiceAmount = FarmerInvoice::where('farmer_id',$farmer_id)->sum('total_amount');
        $advancePayments = Payment::where('farmer_id',$farmer_id)->sum('payment_amount');
        return ($totalInvoiceAmount + $advancePayments + $opening_balance);


    }

    public static function currentChicksPrice(int $farmer_id): string
    {
        $chicksQuantity = FarmerBatch::where('farmer_id',$farmer_id)->where('status','active')->first();
        $totalChicksPrice = 0;
        $sellingPrice = 0;

        if($chicksQuantity !== null)
        {
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
            $sellingPrice = $chicksPrice->selling_price;

        }
        return $totalChicksPrice . '/'. $sellingPrice;
    }

    public static function currentChicks(int $farmer_id):int
    {
        $chicks = FarmerBatch::where('farmer_id',$farmer_id)->where('status','active')->first();
        if (empty($chicks))
        {
            return 0;
        }
        $total_died = FarmerRecord::where('batch_number',$chicks->batch_number)->sum('child_death');

        return ($chicks->chicks_quantity - $total_died);
    }

    public static function runningDay(int $farmer_id):string
    {
        $latestBatch = DB::table('farmer_batches')->where('farmer_id',$farmer_id)->where('status','active')->orderBy('id','desc')->first();
        if (empty($latestBatch))
        {
            return 0;
        }
        $startDate = Carbon::parse($latestBatch->created_at);
        $endDate = Carbon::now();
        return ($startDate->diffInDays($endDate) !== 0 ?$startDate->diffInDays($endDate) + 1 : 1);
    }

    public static function totalDied(int $farmer_id):int
    {
        $batch = DB::table('farmer_batches')->where('farmer_id',$farmer_id)->where('status','active')->orderBy('id','desc')->first();
        $died = FarmerRecord::where('batch_number',$batch->batch_number)->sum('child_death');
        return $died ?? 0;

    }

    public static function totalFeed(int $farmer_id):int
    {
        $batch = DB::table('farmer_batches')->where('farmer_id',$farmer_id)->where('status','active')->orderBy('id','desc')->first();
        $feed = FarmerRecord::where('batch_number',$batch->batch_number)->sum('feed_eaten_kg');
        return $feed ?? 0;
    }

    public static function totalFeedLeft(int $farmer_id):string
    {
        $batch = DB::table('farmer_batches')->where('farmer_id',$farmer_id)->where('status','active')->orderBy('id','desc')->first();


        $feedEaten = FarmerRecord::where('batch_number',$batch->batch_number)->sum('feed_eaten_kg');


        $items = DB::table('farmer_invoice_items')
            ->join('products','farmer_invoice_items.product_id','products.id')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->selectRaw('farmer_invoice_items.product_id,farmer_invoice_items.batch_number,farmer_invoice_items.quantity')
            ->where('categories.name','=','Feeds')
            ->where('farmer_invoice_items.batch_number','=',$batch->batch_number)
            ->groupBy('farmer_invoice_items.product_id')
            ->groupBy('farmer_invoice_items.batch_number')
            ->groupBy('farmer_invoice_items.quantity')
            ->get();

        $feedLeft = $items->sum('quantity') - ($feedEaten / 50);
//        dd($feedLeft);
        return $feedLeft ?? 0;
    }

    public static function totalWeight(int $farmer_id):string
    {
        $batch = DB::table('farmer_batches')->where('farmer_id',$farmer_id)->where('status','active')->orderBy('id','desc')->first();
        $weight = FarmerRecord::where('batch_number',$batch->batch_number)->orderBy('date','desc')->first();

        return $weight->weight ?? 'Not Found';
    }

    public static function records(string $batch_number):object
    {
        return FarmerRecord::where('batch_number',$batch_number)->get();
    }

}
