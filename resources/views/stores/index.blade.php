@extends('layouts.app')

@section('title', 'Store List')

@section('content')
    {{-- Navigation bar with link to employees index page --}}
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('employees.index') }}">Employees</a>
        </div>
    </nav>
    
    {{-- Header section with page title and button to create a new store --}}
    <div class='d-flex justify-content-between align-items-center mt-2 mb-3'>
        <h1>Store List</h1>
        <a href='{{ route('stores.create') }}' class='btn btn-primary'>Add Store</a>
    </div>
    
    {{-- Check if there are no stores to display --}}
    @if ($stores->isEmpty())
        <div class="alert alert-info" role="alert">
            No stores found. Please add a store to see them listed here.
        </div>
    @else
        {{-- Table displaying the list of stores --}}
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Store ID</th>
                    <th>Store Name</th>
                    <th>Address</th>
                    <th>Assigned Users</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop through each store to create a table row --}}
                @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->store_id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->address }}</td>
                        <td>
                            {{-- Button to view employees assigned to this store in a modal --}}
                            {{-- Disabled if the store has no employees --}}
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#employeesModal" data-store-id='{{$store->store_id }}'{{ $store->employees_count == 0 ? 'disabled' : '' }}>
                                View <span class="badge bg-danger ">{{ $store->employees_count }}</span>
                            </button>
                        </td>

                        <td>
                            {{-- Links to show and edit the store --}}
                            <a href='{{ route('stores.show', $store->store_id) }}' class='btn btn-info'>Preview</a>
                            <a href='{{ route('stores.edit', $store->store_id) }}' class='btn btn-primary'>Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Modal dialog for displaying the list of employees --}}
    <div class="modal fade" id="employeesModal" tabindex="-1" aria-labelledby="employeesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="employeesModalLabel">List of Employees</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Table inside the modal to display employee details --}}
                    <table class="table table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id='employeesTableBody'>
                            {{-- Loop through all employees (will be filtered by JavaScript) --}}
                            {{-- @foreach ($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $employee->employee_id }}</th>
                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Wait for the DOM to fully load before executing the script
        document.addEventListener('DOMContentLoaded', function() {
            // Get a reference to the employees modal element
            let employeesModal = document.getElementById('employeesModal');

            // Listen for the Bootstrap modal 'show' event (triggered when the modal is about to be shown)
            employeesModal.addEventListener('show.bs.modal', function(event) {
                // Get the button that triggered the modal (the "View" button clicked)
                let button = event.relatedTarget;
                // Extract the store ID from the button's data attribute
                let storeId = button.getAttribute('data-store-id');

                // Make an AJAX request to fetch employees for the selected store
                fetch(`/stores/${storeId}/employees`)
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        // Find the modal body and its table body element
                        let modalBody = employeesModal.querySelector('.modal-body');
                        let tableBody = modalBody.querySelector('tbody');
                        // Clear any existing table rows
                        tableBody.innerHTML = '';

                        // Loop through each employee in the fetched data
                        data.forEach(employee => {
                            // Create a new table row element
                            let row = document.createElement('tr');
                            // Set the row's HTML content with employee details
                            row.innerHTML = `
                                <th scope="row">${employee.employee_id}</th>
                                <td>${employee.first_name} ${employee.last_name}</td>
                                <td>${employee.position}</td>
                                <td>${employee.is_active == 1 ? 'Active' : 'Inactive'}</td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);
                        });
                    })
                    .catch(error => console.error('Error fetching employees:',
                    error)); // Log any errors to the console
            });
        });
    </script>
@endsection
