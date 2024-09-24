<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
    
    public function index()
    {
        $allCustomers = Customer::all();
        return $allCustomers;
    }

    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}
