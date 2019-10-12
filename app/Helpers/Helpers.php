<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helpers
{
    /*
     * Chicks Stock
     * */

    public static function totalChicksQuantity()
    {
        $chicks = DB::table('product_prices')
            ->join('products','product_prices.product_id','=','products.id')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->selectRaw('product_prices.product_id,sum(product_prices.quantity) quantity,sum(product_prices.sold) sold,sum(product_prices.quantity - product_prices.sold) stock')
            ->where('categories.name','=','Chicks')
            ->groupBy('product_prices.product_id')
            ->get();
        return $chicks->sum('stock');
    }

    /*
     *  Feed Quantity
     * */

    public static function totalFeedQuantity()
    {
        $feed = DB::table('product_prices')
            ->join('products','product_prices.product_id','=','products.id')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->selectRaw('product_prices.product_id,sum(product_prices.quantity) quantity,sum(product_prices.sold) sold,sum(product_prices.quantity - product_prices.sold) stock')
            ->where('categories.name','=','Feeds')
            ->groupBy('product_prices.product_id')
            ->get();
        return $feed->sum('stock');
    }

    /*
     * Medicine Quantity
     * */
    public static function  totalMedicineQuantity()
    {
        $medicine = DB::table('product_prices')
            ->join('products','product_prices.product_id','=','products.id')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->selectRaw('product_prices.product_id,sum(product_prices.quantity) quantity,sum(product_prices.sold) sold,sum(product_prices.quantity - product_prices.sold) stock')
            ->where('categories.name','=','Medicines')
            ->groupBy('product_prices.product_id')
            ->get();
        return $medicine->sum('stock');
    }

    /*
     * Total Stock
     * */

    public static function totalStock()
    {
        $total = DB::table('product_prices')
            ->join('products','product_prices.product_id','=','products.id')
            ->selectRaw('product_prices.product_id,sum(product_prices.quantity) quantity,sum(product_prices.sold) sold,sum(product_prices.quantity - product_prices.sold) stock')
            ->groupBy('product_prices.product_id')
            ->get();
        return $total->sum('stock');
    }
}
