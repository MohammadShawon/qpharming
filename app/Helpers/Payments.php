<?php
namespace App\Helpers;

use App\Models\Payment;
use Carbon\Carbon;

class Payments
{
    /*
     * Daily Total Payment
     * @return totalPayment
     * */
    public static function totalDailyPayment():float
    {
        $today = Carbon::today('+6')->format('Y-m-d');
        $totalPayment = Payment::where('status','active')->where('payment_date','like','%'.$today.'%')->sum('payment_amount');
        return $totalPayment;
    }

    /*
     * Total Payments
     * */
    public static function totalPayment():float
    {
        return Payment::where('status','active')->sum('payment_amount');
    }
}
