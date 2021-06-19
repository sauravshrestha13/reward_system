<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\ExpiredLog;
use App\Reward;

class TaskController extends Controller
{
    public function expireRewards(Request $request)
    {
        $date = "2022-01-01 00:00:00";


        $customers = Customer::all();
        foreach($customers as $customer)
        {
            //calculate rewards that are not expired.
            $unexpired_rewards = $customer->rewards()
                ->whereDate('expiry_date', '>=', $date)
                ->sum('reward_amount');
          
            //calculate expired amount
            $expired_amount = $customer->credit - $unexpired_rewards;

            //update customer credit points
            $customer->credit -= $expired_amount;
            $customer->save();

            //update rewards table set status to "Expired"
            Reward::whereHas('order.customer', function($q) use ($customer) {
                     return $q->where('id', $customer->id);
                })
                ->whereDate('expiry_date', '<=', $date)
                ->update(['expiry_status'=>'Expired']);

            //create expired log record.
            $expired_log = new ExpiredLog;
            $expired_log->customer_id = $customer->id;
            $expired_log->expired_amount = $expired_amount;
            $expired_log->expired_date = $date;
            $expired_log->save();
        }

        $request->session()->flash('success', 'Rewards expiry successful. Expire logs updated. Customer credits updated.');   

        return redirect()->to('/customers');
    }
}
