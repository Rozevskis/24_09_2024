<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    
    
    public function index()
    {
        // Retrieve all customers with their associated orders
        $customers = Customer::with('order')->get();

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
    // Retrieve the customer with the specified ID along with their associated orders
    $customer = Customer::with('order')->findOrFail($id);

    return response()->json($customer);
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
