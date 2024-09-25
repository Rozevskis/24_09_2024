<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    
    
    public function index()
{
    $customersWithOrders = DB::table('customers as c')
        ->join('orders as o', 'c.customer_id', '=', 'o.customer_id')
        ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
        ->select(
            'c.customer_id',
            'c.first_name',
            'c.last_name',
            'c.address',
            'c.city',
            'c.state',
            'c.points',
            'o.order_id',
            'o.order_date',
            'os.name as order_status_name'
        )
        ->get();

    // Grouping the customers and their orders
    $customers = [];
    
    foreach ($customersWithOrders as $record) {
        $customerId = $record->customer_id;
        
        // If the customer is not already in the array, add them
        if (!isset($customers[$customerId])) {
            $customers[$customerId] = [
                'customer_id' => $record->customer_id,
                'first_name' => $record->first_name,
                'last_name' => $record->last_name,
                'address' => $record->address,
                'city' => $record->city,
                'state' => $record->state,
                'points' => $record->points,
                'orders' => []
            ];
        }

        // Add the current order to the customer's orders array
        $customers[$customerId]['orders'][] = [
            'order_id' => $record->order_id,
            'order_date' => $record->order_date,
            'order_status_name' => $record->order_status_name
        ];
    }

    // Convert the associative array to a numerically indexed array
    $customers = array_values($customers);

    return response()->json($customers);
}
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'max:50', 'string'],
            'last_name' => ['required', 'max:50', 'string'],
            'birth_day' => ['date'],
            'phone' => ['required', 'max:50'],
            'address' => ['required', 'max:50', 'string'],
            'city' => ['required', 'max:50', 'string'],
            'state' => ['required', 'max:2', 'string'],
            'points' => ['required']
        ]);

        $customer = Customer::create($data);
        return $customer;
    }

    public function show(string $id)
    {
        $customerWithOrders = DB::table('customers as c')
            ->join('orders as o', 'c.customer_id', '=', 'o.customer_id')
            ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
            ->select(
                'c.customer_id',
                'c.first_name',
                'c.last_name',
                'c.address',
                'c.city',
                'c.state',
                'c.points',
                'o.order_id',
                'o.order_date',
                'os.name as order_status_name'
            )
            ->where('c.customer_id', '=', $id)
            ->get();

        if ($customerWithOrders->isEmpty()) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Organize the response structure
        $customerData = [
            'customer_id' => $customerWithOrders[0]->customer_id,
            'first_name' => $customerWithOrders[0]->first_name,
            'last_name' => $customerWithOrders[0]->last_name,
            'address' => $customerWithOrders[0]->address,
            'city' => $customerWithOrders[0]->city,
            'state' => $customerWithOrders[0]->state,
            'points' => $customerWithOrders[0]->points,
            'orders' => []
        ];

        foreach ($customerWithOrders as $order) {
            $customerData['orders'][] = [
                'order_id' => $order->order_id,
                'order_date' => $order->order_date,
                'order_status_name' => $order->order_status_name
            ];
        }

        return response()->json($customerData);
    }


    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }

    public function returnGoldMembers(){
        // Retrieve all customers
        $customers = Customer::all();

        // Filter customers to get only gold members
        $goldMembers = $customers->filter(function ($customer) {
            return $customer->isGoldMember; // Assuming you have the accessor as isGoldMember
        });

        return $goldMembers;
    }
}
