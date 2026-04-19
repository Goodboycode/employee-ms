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
            @if ($stores->isNotEmpty())
                @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->store_id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->address }}</td>
                        <td></td>

                        <td>
                            <a href='{{ route('stores.show', $store->store_id) }}' class='btn btn-info'>Preview</a>
                            <a href='{{ route('stores.edit', $store->store_id) }}' class='btn btn-primary'>Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No stores found.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
