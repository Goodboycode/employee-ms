@extends('layouts.form')

@section('title', 'Edit Employee')

@section('content')
    <div class="container mt-5">
        <h1>Update Employee</h1>
        <form action='' method='POST'>
            @csrf
            <div class="col-md-3 mb-3">
                <label for="employee_id" class="form-label">Employee Id</label>
                <input type="text" class="form-control" value='{{ old('employee_id', $employee->employee_id) }}'
                    id="employee_id" name="employee_id" aria-label="Disabled input" readonly>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" value='{{ old('employee_id', $employee->employee_id) }}' class="form-control"
                        id="first_name" name="first_name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>

            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class='mb-2'>Assigned Store</label>
                    <select class="form-select" aria-label="Default select">
                        <option selected>Unassigned</option>
                        <option value="1">Store 1</option>
                        <option value="2">Store 2</option>
                        <option value="3">Store 3</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position">
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
                    <input class="form-check-input" type="radio" name="is_active" value='0' id="flexRadioDefault2"
                        checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Inactive
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
