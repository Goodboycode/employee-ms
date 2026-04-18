@extends('layouts.form')

@section('title', 'Update Store')

@section('content')
    <div class="container mt-5 mb-3">
        <a href="{{ route('stores.index') }}" class='btn btn-warning mb-2'>Back</a>
        <h1>Edit Store</h1>
        <form action='{{ route('stores.update', $store->store_id) }}' method='POST'>
            @method('PUT')
            @csrf
            <div class="col-md-3 mb-3">
                <label for="store_id" class="form-label">Store ID</label>
                <input type="text" class="form-control" id="store_id" name="store_id"
                    value='{{ old('store_id', $store->store_id) }}' readonly>
            </div>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="name" class="form-label">Store Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value='{{ old('name', $store->name) }}'>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value='{{ old('address', $store->address) }}'>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
