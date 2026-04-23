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

    {{-- Check if there are no stores to display --}}
    @if ($stores->isEmpty())
        <div class="alert alert-info" role="alert">
            No stores found. Please add a store to see them listed here.
        </div>
    @else
        {{-- Table displaying the list of stores --}}
        <table class='table
            table-striped'>
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
