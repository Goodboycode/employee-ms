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
                    <th>Assigned Staffs</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop through each store to create a table row --}}
                @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->store_id }}</td>
                        <td>{{ $store->store_name }}</td>
                        <td>{{ $store->address }}</td>
                        <td>{{ $store->employees_count }}</td>

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
@endsection
