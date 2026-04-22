@extends('layouts.form')

@section('title', 'Preview Store')
@section('content')
    <div class="container mt-5 mb-3">
        <a href="{{ route('stores.index') }}" class='btn btn-secondary mb-2'>Back</a>
        <h1>Preview Store</h1>
        <form id="deleteForm" action='{{ route('stores.destroy', $store->store_id) }}' method='POST'>
            @method('DELETE')
            @csrf
            <div class="col-md-3 mb-3">
                <label for="store_id" class="form-label">Store ID</label>
                <input type="text" class="form-control" id="store_id" name="store_id"
                    value='{{ old('store_id', $store->store_id) }}' readonly>
            </div>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="store_name" class="form-label">Store Name</label>
                    <input type="text" class="form-control" id="store_name" name="store_name"
                        value='{{ old('store_name', $store->store_name) }}' readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value='{{ $store->address }}'
                    readonly>

                <p class="h3 mt-3">Assigned Staffs</p>
            </div>
            @if ($store->employees->count() > 0)
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
                        @foreach ($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->employee_id }}</th>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-primary" role="alert">
                    No employees assigned to this store.
                </div>
            @endif

            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Delete</button>
        </form>

        <!-- Modal Delete -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Store? Employees under this store will also be deleted.
                        This action cannot be undone.

                        <div class="mt-3">
                            <p class="text-info fst-italic">Note: Assigning employees to another store first is
                                recommended. </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="deleteForm" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
