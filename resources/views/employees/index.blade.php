@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    {{-- Navigation bar with link to stores index page --}}
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('stores.index') }}">Stores</a>
        </div>
    </nav>

    {{-- Header section with page title and button to create a new employee --}}
    <div class='d-flex justify-content-between align-items-center mt-2 mb-3'>
        <h1>Employee List</h1>
        {{-- Button to create a new employee if there are no stores, otherwise show a modal --}}
        @if ($stores->isEmpty())
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Employee
            </button>
        @else
            <a href="{{ route('employees.create') }}" class='btn btn-primary'>Add Employee</a>
        @endif
    </div>

    {{-- Search field --}}
    <div class="col-md-3 mb-3 d-flex align-items-center position-relative">
        <span class='position-absolute top-50 ms-4 start-10 translate-middle text-muted'>
            <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </i>
        </span>
        <input id="search-input" onkeyup="searchFunction()" class="form-control ps-5" placeholder='Search'>
    </div>

    {{-- Modal for employees with no store --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Take Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please add a store first.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Table for displaying the list of employees --}}
    @if ($employees->isEmpty())
        <div class="alert alert-info" role="alert">
            No employees found. Please add an employee to see them listed here.
        </div>
    @else
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
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        @foreach ($stores as $store)
                            @if ($store->store_id === $employee->store_id)
                                <td>{{ $store->store_name }}</td>
                            @endif
                        @endforeach
                        <td>{{ $employee->position }}</td>
                        <td>
                            <a href='{{ route('employees.show', $employee->employee_id) }}' class='btn btn-info'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg>
                            </a>
                            <a href='{{ route('employees.edit', $employee->employee_id) }}' class='btn btn-warning'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script>
        function searchFunction() {
            const input = document.getElementById('search-input');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const txtValue = rows[i].textContent || rows[i].innerText;
                if (txtValue) {
                    rows[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }

            }
        }
    </script>
@endsection
