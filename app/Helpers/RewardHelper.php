<?php

namespace App\Helpers;

use App\Currency;

class RewardHelper
{
    public static function calculateReward($order)
    {
        $currency = Currency::where("name",$order->currency)->get();
        $cf = 1.0000; 

        // if currency doesnt exists, then converting factor assumed to be 1.
        if( $currency->count() > 0 ) 
            $cf = $currency->first()->value;

        // after conversion to USD the value is rounded off to get points.
        return round( $order->sale_amount * $cf);
    }
}
