<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Currency;

class Customer extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Order');
    } 

    public function rewards()
    {
        return $this->hasManyThrough('App\Reward','App\Order');
    } 

    public function expiredLogs()
    {
        return $this->hasMany('App\ExpiredLog');
    } 

    public function getCreditWorthAttribute()
    {   
        $currency = Currency::where( "name", $this->currency )->get();
        $cf = 1.0000; 

        // if currency doesnt exists, then converting factor assumed to be 1.
        if( $currency->count() > 0 ) 
            $cf = $currency->first()->value;

        // after conversion to USD the value is rounded off to get points.
        return number_format( $this->credit * 0.01 / $cf ,2 ,'.' ,'');
    }
}
