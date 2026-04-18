@extends('layouts.form')

@section('title', 'Preview Employee')

@section('content')
    <div class="container mt-5 mb-5">
        <a href="{{ route('employees.index') }}" class='btn btn-warning mb-2'>Back</a>
        <h1>Preview Employee</h1>
        <form action='{{ route('employees.destroy', $employee->employee_id) }}' method='POST'>
            @method('DELETE')
            @csrf
            <div class="col-md-3 mb-3">
                <label for="employee_id" class="form-label">Employee Id</label>
                <input type="text" class="form-control" value='{{ old('employee_id', $employee->employee_id) }}'
                    id="employee_id" name="employee_id" aria-label="Disabled input" readonly>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" value='{{ old('first_name', $employee->first_name) }}' class="form-control"
                        id="first_name" name="first_name" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" value='{{ old('last_name', $employee->last_name) }}' class="form-control"
                        id="last_name" name="last_name" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value='{{ old('email', $employee->email) }}' readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value='{{ old('phone', $employee->phone) }}' readonly>
                </div>

            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value='{{ old('address', $employee->address) }}' readonly>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class='mb-2'>Assigned Store</label>
                    <select class="form-select" aria-label="Default select" @disabled(true)>
                        @foreach ($stores as $store)
                            <option value="{{ old('store_id', $employee->store_id) }}" selected>{{ $store->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position"
                        value='{{ old('position', $employee->position) }}' readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active" value='1' id="flexRadio1" disabled
                        {{ $employee->is_active == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadio1">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active" value='0' id="flexRadio2" disabled
                        {{ $employee->is_active == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadio2">
                        Inactive
                    </label>
                </div>
            </div>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Delete</button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this employee? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
