<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all employees and pass them to the index view
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'employee_id' => 'required|unique:employees, employee_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees, email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'store_id'=> 'required|exists:stores, store_id',
            'position' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        // Create and save the new store into the database and redirect back to the store list with a success message
        Employee::create($validatedData);
        return redirect()->route('employee.index')->with('success','Employee created successfully');
            

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // $task is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // $task is already resolved by the framework. 
        // If the ID doesn't exist, Laravel throws a 404 automatically.
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'position' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        // Update the employee and redirect back to the employee list with a success message
        $employee->update($validatedData);
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
