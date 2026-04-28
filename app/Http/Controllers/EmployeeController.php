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
    public function index(Request $request)
    {
        // Fetch all stores to populate "Assign Store" or "Filter" dropdowns in the view
        $stores = Store::all();

        // Initialize a new Eloquent query builder for the Employee model
        $query = Employee::query();

        // Check if the user has submitted a search query
        if ($request->has("search") && $request->search != "") {
            $searchTerm = $request->search;

            // Group the search conditions within a logical "WHERE (...)" clause 
            // to ensure it doesn't conflict with other potential query conditions
            $query->where(function($q) use ($searchTerm){
                $q->where('first_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('position', 'LIKE', "%{$searchTerm}%")
                  // Perform an underlying INNER JOIN to search by the related store's name
                  ->orWhereHas('store', function($q) use ($searchTerm){
                      $q->where('store_name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }
        
        // Execute the query and paginate the results (10 employees per page)
        $employees = $query->paginate(10);
        
        // Return the 'employees.index' Blade view, passing the employees and stores data
        return view('employees.index', compact('employees', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all stores so the user can select one from a dropdown when creating an employee
        $stores = Store::all();

        // Return the Blade view containing the 'Create Employee' HTML form
        return view('employees.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming POST request data based on specific rules.
        // If validation fails, Laravel will automatically redirect the user back with error messages.
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email', // Must be unique in the 'employees' table
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'store_id'   => 'required|exists:stores,store_id',       // Must exist in the 'stores' table
            'position'   => 'required|string|max:255',
            'is_active'  => 'required|boolean',
        ]);

        // Mass-assign the validated data to create a new Employee record in the database
        Employee::create($validatedData);
        
        // Redirect the user back to the employee listing page and flash a success message to the session
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // Through "Route Model Binding", Laravel automatically fetches the Employee record.
        // If the ID in the URL doesn't exist in the DB, it throws a 404 Not Found error.
        
        // We fetch stores in case the view needs to display store details or comparisons
        $stores = Store::all();
        
        // Return the view to display the specific employee's detailed information
        return view('employees.show', compact('employee', 'stores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // Route Model Binding automatically fetches the specific employee to edit.
        
        // Fetch all stores to populate the "Assign Store" dropdown in the edit form
        $stores = Store::all();
        
        // Return the edit form view, passing both the existing employee data and the available stores
        return view('employees.edit', compact('employee', 'stores'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the incoming PUT/PATCH request data
        // Note: We don't validate email uniqueness here because it's not being updated 
        // or we'd need to ignore the current employee's email ID.
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'store_id'   => 'required|exists:stores,store_id',
            'position'   => 'required|string|max:255',
            'is_active'  => 'required|in:1,0',
        ]);

        // Update the existing employee record in the database with the newly validated data
        $employee->update($validatedData);
        
        // Redirect the user back to the employee listing page with a success message
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // The employee record is deleted from the database
        // Note: $employee->delete() does not need an argument passed to it
        $employee->delete();
        
        // Redirect the user back to the employee list and show a success confirmation message
        return redirect()->route('employees.index')->with('success', 'Employee successfully deleted');
    }
}
