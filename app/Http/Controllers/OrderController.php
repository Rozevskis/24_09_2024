<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($customer_id)
    {
        // Retrieve customer with their associated orders
        $customer = Customer::with('orders') // Only include orders
            ->where('customer_id', $customer_id) // Use your actual primary key
            ->firstOrFail();

        return response()->json($customer->orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, Order $order)
    {
        // Check if the order belongs to the customer
        if ($order->customer_id !== $customer->customer_id) {
            return response()->json(['message' => 'Order not found for this customer.'], 404);
        }

        return response()->json($order);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
