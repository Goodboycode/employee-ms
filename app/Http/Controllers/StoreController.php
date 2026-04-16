<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all employees and pass them to the index view
        $store = Store::all();
        return view('store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'store_id' => 'required|unique:stores, store_id',
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
        // $task is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.

        return view('store.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        // $task is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.
        return view('store.edit', compact('store'));
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
        return redirect()->route('store.index')->with('success', 'Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
