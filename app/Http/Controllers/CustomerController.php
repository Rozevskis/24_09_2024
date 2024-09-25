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
                'o.order_date',
                'os.name as order_status_name'
            )
            ->get();

        return response()->json($customersWithOrders);
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
        $customer = Customer::findOrFail($id);
        return $customer;
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
