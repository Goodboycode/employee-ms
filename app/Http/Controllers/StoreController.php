<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
        return view('store.index', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'store_id' => 'required|unique:stores, store_id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255'
        ]);

        Store::create($validatedData);
        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $store = Store::findOrFail($id);
        return view('store.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
