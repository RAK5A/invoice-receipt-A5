<?php

namespace App\Http\Controllers;

use App\Models\StoreCustomer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers
     */
    public function index()
    {
        $customers = StoreCustomer::orderBy('created_at', 'desc')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'town' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'phone' => 'required|string|max:100',
            
            // Shipping information
            'name_ship' => 'required|string|max:255',
            'address_1_ship' => 'required|string|max:255',
            'address_2_ship' => 'nullable|string|max:255',
            'town_ship' => 'required|string|max:255',
            'county_ship' => 'required|string|max:255',
            'postcode_ship' => 'required|string|max:255',
        ]);

        StoreCustomer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer has been created successfully!');
    }

    /**
     * Show the form for editing a customer
     */
    public function edit(StoreCustomer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer
     */
    public function update(Request $request, StoreCustomer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'town' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'phone' => 'required|string|max:100',
            
            // Shipping information
            'name_ship' => 'required|string|max:255',
            'address_1_ship' => 'required|string|max:255',
            'address_2_ship' => 'nullable|string|max:255',
            'town_ship' => 'required|string|max:255',
            'county_ship' => 'required|string|max:255',
            'postcode_ship' => 'required|string|max:255',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer has been updated successfully!');
    }

    /**
     * Remove the specified customer
     */
    public function destroy(StoreCustomer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer has been deleted successfully!');
    }
}
