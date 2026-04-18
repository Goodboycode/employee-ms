@extends('layouts.form')

@section('title', 'Preview Store')

@section('content')
    <div class="container mt-5 mb-3">
        <a href="{{ route('stores.index') }}" class='btn btn-warning mb-2'>Back</a>
        <h1>Preview Store</h1>
        <form action='{{ route('stores.destroy', $store->store_id) }}' method='POST'>
            @method('DELETE')
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
                        value='{{ old('name', $store->name) }}' readonly>
                </div>
            </div>


            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value='{{ $store->address }}'
                    readonly>
            </div>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Delete</button>

            <!-- Modal -->
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
                                <p class="text-info fst-italic">Note: Assigning employees to a new store first is
                                    recommended.</p>
                            </div>
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
