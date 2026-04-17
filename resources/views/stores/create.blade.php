@extends('layouts.form')

@section('title', 'Create Stores')

@section('content')
    <div class="container mt-5">
        <h1>Add Store</h1>
        <form action='{{ route('stores.store') }}' method='POST'>
            @csrf
            <div class="col-md-3 mb-3">
                <label for="store_id" class="form-label">Store ID</label>
                <input type="text" class="form-control" id="store_id" name="store_id">
            </div>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="name" class="form-label">Store Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>


            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
