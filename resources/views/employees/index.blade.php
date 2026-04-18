@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('stores.index')}}">Stores</a>
        </div>
    </nav>
    <div class='d-flex justify-content-between align-items-center mt-2 mb-3'>
        <h1>Employee List</h1>
        <a href='{{ route('employees.create') }}' class='btn btn-primary'>Add Employee</a>
    </div>
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
            @if ($employees->isNotEmpty())
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>

                        <td>{{ $employee->store->name ?? 'Unassigned' }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>
                            <a href='{{ route('employees.show', $employee->employee_id) }}' class='btn btn-info'>Preview</a>
                            <a href='{{ route('employees.edit', $employee->employee_id) }}' class='btn btn-warning'>Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">No employees found.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
