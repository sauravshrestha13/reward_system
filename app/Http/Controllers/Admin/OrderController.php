<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Customer;
use App\Reward;
use App\Currency;
use Carbon\Carbon;
use App\Helpers\RewardHelper;

use Session;
use Redirect;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at','desc')->paginate(10);
        $customers = Customer::all();
        
        return view('admin.orders.index')->with('orders',$orders)->with('customers',$customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([          
            'name' => 'required|max:191',
            'customer_id' => 'required|exists:customers,id',
            'sale_amount' => 'required|numeric'
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $currency = Currency::where('name',$customer->currency)->first();


        //create new order record
        $order = new Order;
        $order->name = $request->name;
        $order->customer_id = $request->customer_id;
        $order->sale_amount = $request->sale_amount;
        $order->status = "Pending";
        $order->currency = $currency->name;
        $order->currency_value = $currency->value;

        $order->save();

        $request->session()->flash('success', 'Order added.');        
        
        return redirect()->to('/');
    }

    public function completeOrder(Request $request)
    {
        $request->validate([          
            'id' => 'required|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->id);
        $customer = Customer::findOrFail($order->customer_id);


        if($order->status != "Pending")
        {
            $request->session()->flash('error', 'Order is Already Completed.');   
            return redirect()->to('/');
        }

        //Create new reward record
        $reward = new Reward;
        $reward->order_id = $order->id;
        $reward->expiry_date = Carbon::now()->addYears(1);
        $reward->expiry_status = "Active";
        $reward->reward_amount = RewardHelper::calculateReward( $order );
        $reward->save();

        //set order status to completed
        $order->status = "Completed";
        $order->save();

        //update credit points of customer
        $customer->credit += $reward->reward_amount;
        $customer->save();

        $request->session()->flash('success', 'Order Completed. Reward points added.');   

        return redirect()->to('/');
    }
}
