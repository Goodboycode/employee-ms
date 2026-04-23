@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    {{-- Navigation bar with link to stores index page --}}
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('stores.index') }}">Stores</a>
        </div>
    </nav>

    {{-- Header section with page title and button to create a new employee --}}
    <div class='d-flex justify-content-between align-items-center mt-2 mb-3'>
        <h1>Employee List</h1>
        {{-- Button to create a new employee if there are no stores, otherwise show a modal --}}
        @if ($stores->isEmpty())
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Employee
            </button>
        @else
            <a href="{{ route('employees.create') }}" class='btn btn-primary'>Add Employee</a>
        @endif
    </div>

    {{-- Search field --}}
    <div class="col-md-3 mb-3 d-flex align-items-center">
        <span class='position-absolute text-muted' style='top:21%; left:85px; transform: translateY(-50%); z-index:10;'>
            <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </i>
        </span>
        <input class="form-control ps-5" type="search" placeholder='Search'>
        <button type='submit' class="btn btn-primary">Search</button>
    </div>

    {{-- Modal for employees with no store --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Take Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please add a store first.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Table for displaying the list of employees --}}
    @if ($employees->isEmpty())
        <div class="alert alert-info" role="alert">
            No employees found. Please add an employee to see them listed here.
        </div>
    @else
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Assigned Store</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        @foreach ($stores as $store)
                            @if ($store->store_id === $employee->store_id)
                                <td>{{ $store->store_name }}</td>
                            @endif
                        @endforeach
                        <td>{{ $employee->position }}</td>
                        <td>
                            <a href='{{ route('employees.show', $employee->employee_id) }}' class='btn btn-info'>Preview</a>
                            <a href='{{ route('employees.edit', $employee->employee_id) }}' class='btn btn-primary'>Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
