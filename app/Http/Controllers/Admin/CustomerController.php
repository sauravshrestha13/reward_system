<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('admin.customers.index')->with('customers',$customers);
    }

    public function rewards(Request $request)
    {
        $request->validate([          
            'customer_id' => 'required|exists:customers,id',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $rewards = $customer->rewards()->paginate(10);

        return view('admin.rewards.index')->with('rewards',$rewards)->with('customer',$customer);
    }

    public function expiryLogs(Request $request)
    {
        $request->validate([          
            'customer_id' => 'required|exists:customers,id',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $logs = $customer->expiredLogs()->paginate(10);

        return view('admin.expirylogs.index')->with('logs',$logs)->with('customer',$customer);

    }
}
