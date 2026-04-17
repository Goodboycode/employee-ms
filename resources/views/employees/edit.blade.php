@extends('layouts.form')

@section('title', 'Edit Employee')

@section('content')
    <div class="container mt-5">
        <h1>Update Employee</h1>
        <form action='{{ route('employees.update', $employee->id) }}' method='PUT'>
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
                        id="first_name" name="first_name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" value='{{ old('last_name', $employee->last_name) }}' class="form-control"
                        id="last_name" name="last_name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value='{{ old('email', $employee->email) }}'>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value='{{ old('phone', $employee->phone) }}'>
                </div>

            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value='{{ old('address', $employee->address) }}'>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class='mb-2'>Assigned Store</label>
                    <select class="form-select" aria-label="Default select"
                        value='{{ old('store_id', $employee->store_id) }}'>
                        @foreach ($stores as $store)
                            <option value="{{ $store->store_id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position"
                        value='{{ old('position', $employee->position) }}'>
                </div>
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active" value='1' id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active"
                        value='{{ old('is_active', $employee->is_active) }}' id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Inactive
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
