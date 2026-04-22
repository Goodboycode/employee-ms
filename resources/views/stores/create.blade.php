@extends('layouts.form')

@section('title', 'Create Stores')
@section('content')

    <div class="container mt-5 mb-3">
        <a href="{{ route('stores.index') }}" class='btn btn-secondary mb-2'>Back</a>
        <h1>Add Store</h1>
        <form action='{{ route('stores.store') }}' method='POST'>
            @csrf
            <div class="col-md-5 mb-3">

                <label for="store_name" class="form-label">Store Name</label>
                <input type="text" value='{{ old('store_name') }}'
                    class="form-control @error('store_name') is-invalid @enderror" id="store_name" name="store_name">
                @error('store_name')
                    <div class='text-danger'>{{ $message }}</div>
                @enderror

            </div>


            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" value='{{ old('address') }}' class="form-control" id="address" name="address">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
