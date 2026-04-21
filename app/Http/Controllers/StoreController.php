<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Employee;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all stores with employee count and pass them to the index view
        $stores = Store::withCount('employees')->get();
        $employees = Employee::all();
        return view('stores.index', compact('stores', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // store form in the UI 
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255'
        ]);

        // Create and save the new store into the database and redirect back to the store list with a success message
        Store::create($validatedData);
        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        // $store is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.
        $employees = $store->employees;
        return view('stores.show', compact('store','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        // $task is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.
        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255'
        ]);

        // Update the employee and redirect back to the employee list with a success message
        $store->update($validatedData);
        return redirect()->route('stores.index')->with('success', 'Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        // The store is permanently removed from the 'stores' table and redirected back to the store list with a success message
        $store->delete();
        return redirect()->route('stores.index')->with('success','store successfully deleted');
    }
}
