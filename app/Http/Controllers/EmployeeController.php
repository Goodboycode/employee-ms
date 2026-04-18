<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all employees and pass them to the index view
        $stores = Store::all();
        $employees = Employee::all();
        return view('employees.index', compact('employees', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // employee form in the UI
        $stores = Store::all();

        return view('employees.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'store_id' => 'required|exists:stores,store_id',
            'position' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // Create and save the new employee into the database and redirect back to the employee list with a success message
        Employee::create($validatedData);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // $employee is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.
        $stores = Store::all();
        return view('employees.show', compact('employee', 'stores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // $employee is already resolved by the framework.
        // If the ID doesn't exist, Laravel throws a 404 automatically.
        $stores = Store::all();
        return view('employees.edit', compact('employee', 'stores'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // dd($request);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'store_id' => 'required|exists:stores,store_id',
            'position' => 'required|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        // Update the employee and redirect back to the employee list with a success message
        
        $employee->update($validatedData);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // The employee is permanently removed from the 'employees' table and redirected back to the employee list with a success message
        $employee->delete($employee);
        return redirect()->route('employees.index')->with('success', 'Employee successfully deleted');
    }
}
