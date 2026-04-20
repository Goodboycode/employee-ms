@extends('layouts.app')

@section('title', 'Store List')

@section('content')
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('employees.index') }}">Employees</a>
        </div>
    </nav>
    <div class='d-flex justify-content-between align-items-center mt-2 mb-3'>
        <h1>Store List</h1>
        <a href='{{ route('stores.create') }}' class='btn btn-primary'>Add Store</a>
    </div>
    @if ($stores->isEmpty())
        <div class="alert alert-info" role="alert">
            No stores found. Please add a store to see them listed here.
        </div>
    @else
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
                @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->store_id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->address }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#employeesModal">
                                View <span class="badge bg-danger ">{{ $store->employees_count }}</span>
                            </button>
                        </td>

                        <td>
                            <a href='{{ route('stores.show', $store->store_id) }}' class='btn btn-info'>Preview</a>
                            <a href='{{ route('stores.edit', $store->store_id) }}' class='btn btn-primary'>Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal List of Employees -->

    <div class="modal fade" id="employeesModal" tabindex="-1" aria-labelledby="employeesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="employeesModalLabel">List of Employees</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($stores as $store)
                        <table class="table table-striped-columns">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    @if ($employee->store_id == $store->store_id)
                                        <tr>
                                            <th scope="row">{{ $employee->employee_id }}</th>
                                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>{{ $employee->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
