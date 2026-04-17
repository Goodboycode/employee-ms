@extends('layouts.app')

@section('title', 'Store List')

@section('content')
    <div class='d-flex justify-content-between align-items-center mt-5'>
        <h1>Store List</h1>
        <a href='{{ route('stores.create') }}'class='btn btn-primary'>Add Store</a>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Store ID</th>
                <th>Store Name</th>
                <th>Address</th>
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
                        <td>

                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No stores found.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
