<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($customerId)
    {
        $ordersWithStatus = DB::table('orders as o')
            ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
            ->select(
                'o.order_id',
                'o.customer_id',
                'o.order_date',
                'os.name as Order_Status',  // Alias for the order status name
                'o.comments',
                'o.shipped_date',
                'o.shipper_id'
            )
            ->where('o.customer_id', $customerId)  // Filter by customer ID
            ->get();  // Execute the query

        return response()->json($ordersWithStatus);
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
    public function show(Order $order)
    {
        $ordersWithStatus = DB::table('orders as o')
        ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
        ->select(
            'o.order_id',
            'o.customer_id',
            'o.order_date',
            'os.name as Order_Status',  // Alias for the order status name
            'o.comments',
            'o.shipped_date',
            'o.shipper_id'
        )
        ->where('o.customer_id', $customerId)  // Filter by customer ID
        ->where('c.customer_id', '=', $id)
        ->get();  // Execute the query

    return response()->json($ordersWithStatus);
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
