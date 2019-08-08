<?php
namespace App\Helpers;

use App\Models\Collection;
use Carbon\Carbon;

class Collections
{
    /*
     * Daily Collection
     * @return float
     * */

    public static function dailyTotalCollection():float
    {
        $today = Carbon::today('+6')->format('Y-m-d');
        $totalCollection = Collection::where('collection_date','like','%'.$today.'%')->sum('collection_amount');
        return $totalCollection;
    }

    /*
     *  All Collection
     * @return float
     * */

    public static function totalCollection():float
    {
        return Collection::sum('collection_amount');
    }
}
